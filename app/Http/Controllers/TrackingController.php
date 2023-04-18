<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visits;
use App\Models\Website;
use App\Models\Segmentation;
use App\Services\IPLookUp\IPRegistryService;
use App\Services\Contacts\HunterService;
use App\Models\CompanyLeads;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;
use App\Services\Companies\CompaniesAPIService;
// use carbon
use Carbon\Carbon;


class TrackingController extends Controller
{
    /**
     * Get the tracking script for the given tracking code.
     *
     * @param  string $trackingCode
     * @return \Illuminate\Http\Response
     */
    public function getTrackingScript($trackingCode)
    {
        // check tracking code is in request
        if (!$trackingCode) {
            abort(403);
        }

        // TO DO: minimist the js in this string
        // TO DO: add a check to see if the tracking code is valid
        // TO DO: add a check to see if traffic is headless was causing error
        // TO DO: add a check to stop ddos attacks

        // check what website the tracking code is being requested form
        $website = Website::where('tracking_code', $trackingCode)->first();

        // update the tracking website
        if($website->tracking_status == 0){
            $website->tracking_status = 1;
        }
        $website->save();

        $trackingScript = <<<SCRIPT
        (function() {
            function generateUUID() {
                var d = new Date().getTime();
                var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                  var r = (d + Math.random() * 16) % 16 | 0;
                  d = Math.floor(d / 16);
                  return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                });
                return uuid;
            }
            function isBot() {
                var botRegex = /bot|crawl|slurp|spider/i;
                return botRegex.test(navigator.userAgent);
            }
            function isHeadless() {
                return !window.chrome || !window.chrome.webstore || !window.chrome.webstore.install;
            }
            function getVisitorId() {
                var visitorId = null;
                if (!isBot()) {
                  console.log('not a bot');
                  var cookies = document.cookie.split(';');
                  for (var i = 0; i < cookies.length; i++) {
                      var cookie = cookies[i].trim();
                      if (cookie.indexOf('visitor_id=') === 0) {
                        visitorId = cookie.substring('visitor_id='.length, cookie.length);
                        break;
                      }
                  }
                  if (!visitorId) {
                      visitorId = generateUUID();
                      console.log('visitorId by geneateUUID', visitorId);
                      var date = new Date();
                      date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // cookie expires in 30 days
                      var expires = "expires="+date.toUTCString();
                      document.cookie = "visitor_id=" + visitorId + ";" + expires + ";path=/";
                  }
                }
                return visitorId;
            }
            function debounce(func, wait) {
              var timeout;
              return function() {
                var context = this;
                var args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                  timeout = null;
                  func.apply(context, args);
                }, wait);
              };
            }
            function getIpAddress() {
                return new Promise(function(resolve, reject) {
                  var xhr = new XMLHttpRequest();
                  xhr.open('GET', 'https://api.ipify.org?format=json', true);
                  xhr.onload = function() {
                    if (xhr.status === 200) {
                      var response = JSON.parse(xhr.responseText);
                      resolve(response.ip);
                    } else {
                      reject(xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    reject(xhr.statusText);
                };
                xhr.send();
                });
            }
            function getSessionDuration() {
                var duration = Math.floor((Date.now() - (sessionStorage.getItem('start_time') || Date.now())) / 1000);
                sessionStorage.setItem('start_time', Date.now());
                return duration;
            }
            function getQueryStringParams() {
                var params = {};
                var search = window.location.search.substring(1);
                if (search) {
                var parts = search.split('&');
                for (var i = 0; i < parts.length; i++) {
                    var keyValuePair = parts[i].split('=');
                    if (keyValuePair.length === 2) {
                    params[keyValuePair[0]] = decodeURIComponent(keyValuePair[1].replace(/\+/g, ' '));
                    }
                }
                }
                return params;
            }
            function sendTrackingData() {
              var visitorId = getVisitorId();
              if (visitorId) {
                  var data = {
                    visitor_id: visitorId,
                    website_id: '$trackingCode',
                    referrer: document.referrer,
                    url: window.location.href,
                    title: document.title,
                    session_duration: getSessionDuration(),
                    query_string_params: getQueryStringParams(),
                    screen_size: {
                      width: window.screen.width,
                      height: window.screen.height
                    },
                    device_type: /Mobi/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
                    operating_system: navigator.platform,
                    browser_version: navigator.userAgent
                  };
                  var request = new XMLHttpRequest();
                  request.open('POST', 'https://app.leadrhino.io/api/tracking', true);
                  request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                  request.send(JSON.stringify(data));
              }
            }
            if (navigator.sendBeacon) {
              window.addEventListener('unload', function() {
                var visitorId = getVisitorId();
                if (visitorId) {
                  var data = {
                      visitor_id: visitorId,
                      website_id: '$trackingCode',
                      referrer: document.referrer,
                      url: window.location.href,
                      title: document.title,
                      session_duration: getSessionDuration(),
                      query_string_params: getQueryStringParams(),
                      screen_size: {
                        width: window.screen.width,
                        height: window.screen.height
                      },
                      device_type: /Mobi/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
                      operating_system: navigator.platform,
                      browser_version: navigator.userAgent
                    };
                    navigator.sendBeacon('https://app.leadrhino.io/api/tracking', JSON.stringify(data));
                };
              });
            } else {
              sendTrackingDataOnEvent('beforeunload');
            }
            var debouncedSendTrackingData = debounce(sendTrackingData, 2000);
            function sendTrackingDataOnEvent(event) {
              if (event === 'load') {
                window.addEventListener(event, function() {
                  sendTrackingData();
                  window.addEventListener(event, debouncedSendTrackingData);
                });
              } else {
                window.addEventListener(event, debouncedSendTrackingData);
              }
            }
            sendTrackingDataOnEvent('load');
            sendTrackingDataOnEvent('scroll');
            sendTrackingDataOnEvent('click');
            debouncedSendTrackingData();
        })();
        SCRIPT;

        return response($trackingScript, 200)->header('Content-Type', 'application/javascript')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    public function tracking(Request $request)
    {
        // get domain from request
        $domain = $request->header('origin');

        $data = $request->all();
        $data['user_agent'] = $request->header('User-Agent');
        $data['ip_address'] = $data['ip_address'] ?? $request->ip();
        $data['session_duration'] = $data['session_duration'] ?? 0;
        $data['query_string_params'] = json_encode($data['query_string_params']);
        $data['screen_size_width'] = $data['screen_size']['width'];
        $data['screen_size_height'] = $data['screen_size']['height'];
        $data['device_type'] = $data['device_type'] ?? 'unknown';
        $data['operating_system'] = $data['operating_system'] ?? 'unknown';
        $data['browser_version'] = $data['browser_version'] ?? 'unknown';
        $data['referrer'] = $data['referrer'] ?? 'unknown';
        $data['url'] = $data['url'] ?? 'unknown';
        $data['title'] = $data['title'] ?? 'unknown';
        $website_id = $data['website_id'] ?? 'unknown';
        $data['created_at'] = Carbon::now();
        $data['timestamp'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        // make this more secure by checking request origin against website domain
        // TO DO: check request origin against website domain


        // get website from tracking code
        $website = Website::where('tracking_code', $website_id)->first();
        if ($website) {
            $data['website_id'] = $website->id;
        } else {
            // error if website not found abort(404);
            abort(404, 'Website not found');
        }
        
        // update the last event time
        $website->last_event_time = Carbon::now();
        $website->save();

        // get company from ip using IPRegistry Service
        $ipRegistry = new IPRegistryService();
        $companyData = $ipRegistry->getCompanyFromIP($data['ip_address']);

        // TO DO: have more than one company lookup service

        // get company data 
        $company = $companyData['company'] ?? null;
        if ($company['type'] == 'business') {

            // validate company data
            if(empty($company['name']) || empty($company['domain'])){
              return response()->json(['success' => false, 'message' => 'Company name or domain is missing']);
            } else {
              // check if company already exists where website_id and domain match
              $companyLead = CompanyLeads::where('website_id', $website->id)->where('domain', $company['domain'])->first();
              if ($companyLead) {
                // create visits and associate with company lead
                $visit = Visits::create($data);
                $visit->company_leads_id = $companyLead->id;
                $visit->save();
                return response()->json(['success' => true, 'message' => 'Visit created']);
              }

              //  Data Enrichment 2 - CompaniesAPI
              $companiesAPI = new CompaniesAPIService();
              $companiesAPIData = $companiesAPI->getCompanyByDomain($company['domain']);

              if ($companiesAPIData) {
                // get logo
                $company['logo'] = $companiesAPIData['logo'] ?? null;
                // get company description
                $company['description'] = $companiesAPIData['description'];
                // get company phone
                $company['phone'] = $companiesAPIData['phoneNumber'] ?? null;
                // get company size
                $company['size'] = $companiesAPIData['totalEmployeesExact'] ?? null;
                // get company industry
                $company['industry'] = $companiesAPIData['industryMain'] ?? null;
                // socials
                $company['facebook'] = $companiesAPIData['socialNetworks']['facebook'] ?? null;
                $company['twitter'] = $companiesAPIData['socialNetworks']['twitter'] ?? null;
                $company['linkedin'] = $companiesAPIData['socialNetworks']['linkedin'] ?? null;
                $company['instagram'] = $companiesAPIData['socialNetworks']['instagram'] ?? null;
                $company['youtube'] = $companiesAPIData['socialNetworks']['youtube'] ?? null;

                if($companiesAPIData['state']){
                  $company['state'] = $companiesAPIData['state']['name'];
                }
                if($companiesAPIData['city']){
                  $company['city'] = $companiesAPIData['city']['name'];
                  $company['zip'] = $companiesAPIData['city']['postcode'];
                }
                if($companiesAPIData['country']){
                  $company['country'] = $companiesAPIData['country']['name'];
                }
              }
              
              // TO DO: more and better data enrichment services

              // if company does not exist create new company lead
              $companyLead = CompanyLeads::create([
                'name' => $company['name'],
                'domain' => $company['domain'],
                'description' => $company['description'] ?? null,
                'industry' => $company['industry'] ?? null,
                'size' => $company['size'] ?? null,
                'phone' => $company['phone'] ?? null,
                'address' => $company['address'] ?? null,
                'state' => $company['state'] ?? null,
                'city' => $company['city'] ?? null,
                'country' => $company['country'] ?? null,
                'zip' => $company['zip'] ?? null,
                'latitude' => $companyData['location']['latitude'] ?? null,
                'longitude' => $companyData['location']['longitude'] ?? null,
                'timezone' => $companyData['time_zone']['abbreviation'] ?? null,
                'timezone_offset' => $companyData['time_zone']['offset'] ?? null,
                'local_time' => $companyData['time_zone']['current_time'] ?? null,
                'facebook_url' => $company['facebook'] ?? null,
                'linkedin_url' => $company['linkedin'] ?? null,
                'twitter_url' => $company['twitter'] ?? null,
                'youtube_url' => $company['youtube'] ?? null,
                'logo' => $company['logo'] ?? null,
                'website_id' => $website->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ]);

              // TO DO: make this more dynamic in determining if the website is active
              // set website tracking staus to active if not active
              if($website->tracking_status == 0){
                $website->tracking_status = 1;
                $website->save();
              }

              // create visits and associate with company lead
              $visit = Visits::create($data);
              $visit->company_leads_id = $companyLead->id;
              $visit->save();

              // get all segments for website
              $segments = Segmentation::where('website_id', $website->id)->get();
              // for each segment check if lead matches segment
              foreach ($segments as $segment){
                // check if lead matches segment
                $query = CompanyLeads::query(); // Initialize a new Eloquent query builder instance for the CompanyLead model
                $segment->applyToQuery($query);
                if ($query->where('id', $companyLead->id)->exists()) {
                  // get users associated with segment
                  $users = $segment->users;
                  // for each user add lead to user
                  foreach ($users as $user){
                    $user->companyLeads()->attach($companyLead->id);
                    // TO DO: Send Notification to user and team via email and other integrations
                  }
                }
              }

              return response()->json(['success' => true]);
            }
        }
    }
}


// legacy tracking:
// $trackingScript = <<<SCRIPT
// (function() {
//     function generateUUID() {
//         var d = new Date().getTime();
//         var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
//           var r = (d + Math.random() * 16) % 16 | 0;
//           d = Math.floor(d / 16);
//           return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
//         });
//         return uuid;
//     }
//     function isBot() {
//         var botRegex = /bot|crawl|slurp|spider/i;
//         return botRegex.test(navigator.userAgent);
//     }
//     function isHeadless() {
//         return !window.chrome || !window.chrome.webstore || !window.chrome.webstore.install;
//     }
//     function getVisitorId() {
//         var visitorId = null;
//         if (!isBot()) {
//           console.log('not a bot');
//           var cookies = document.cookie.split(';');
//           for (var i = 0; i < cookies.length; i++) {
//               var cookie = cookies[i].trim();
//               if (cookie.indexOf('visitor_id=') === 0) {
//                 visitorId = cookie.substring('visitor_id='.length, cookie.length);
//                 break;
//               }
//           }
//           if (!visitorId) {
//               visitorId = generateUUID();
//               console.log('visitorId by geneateUUID', visitorId);
//               var date = new Date();
//               date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // cookie expires in 30 days
//               var expires = "expires="+date.toUTCString();
//               document.cookie = "visitor_id=" + visitorId + ";" + expires + ";path=/";
//           }
//         }
//         return visitorId;
//     }
//     function debounce(func, wait) {
//       var timeout;
//       return function() {
//         var context = this;
//         var args = arguments;
//         clearTimeout(timeout);
//         timeout = setTimeout(function() {
//           timeout = null;
//           func.apply(context, args);
//         }, wait);
//       };
//     }
//     function getIpAddress() {
//         return new Promise(function(resolve, reject) {
//           var xhr = new XMLHttpRequest();
//           xhr.open('GET', 'https://api.ipify.org?format=json', true);
//           xhr.onload = function() {
//             if (xhr.status === 200) {
//               var response = JSON.parse(xhr.responseText);
//               resolve(response.ip);
//             } else {
//               reject(xhr.statusText);
//             }
//         };
//         xhr.onerror = function() {
//             reject(xhr.statusText);
//         };
//         xhr.send();
//         });
//     }
//     function getSessionDuration() {
//         var duration = Math.floor((Date.now() - (sessionStorage.getItem('start_time') || Date.now())) / 1000);
//         sessionStorage.setItem('start_time', Date.now());
//         return duration;
//     }
//     function getQueryStringParams() {
//         var params = {};
//         var search = window.location.search.substring(1);
//         if (search) {
//         var parts = search.split('&');
//         for (var i = 0; i < parts.length; i++) {
//             var keyValuePair = parts[i].split('=');
//             if (keyValuePair.length === 2) {
//             params[keyValuePair[0]] = decodeURIComponent(keyValuePair[1].replace(/\+/g, ' '));
//             }
//         }
//         }
//         return params;
//     }
//     var debouncedSendTrackingData = debounce(sendTrackingData, 5000);
//     function sendTrackingDataOnEvent(event) {
//       window.addEventListener(event, function() {
//         debouncedSendTrackingData();
//       });
//     }
//     function sendTrackingData() {
//       console.log("sendTrackingData() called");
//       var visitorId = getVisitorId();
//       console.log("visitorId", visitorId);
//       if (visitorId) {
//         console.log('Visitor ID:', visitorId);
//         getIpAddress().then(function(ipAddress) {
//           var data = {
//             visitor_id: visitorId,
//             website_id: '$trackingCode',
//             referrer: document.referrer,
//             url: window.location.href,
//             title: document.title,
//             ip_address: ipAddress,
//             session_duration: getSessionDuration(),
//             query_string_params: getQueryStringParams(),
//             screen_size: {
//               width: window.screen.width,
//               height: window.screen.height
//             },
//             device_type: /Mobi/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
//             operating_system: navigator.platform,
//             browser_version: navigator.userAgent
//           };
//           console.log('Data:', data);
//           var request = new XMLHttpRequest();
//           request.open('POST', 'https://app.leadrhino.io/api/tracking', true);
//           request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
//           request.send(JSON.stringify(data));
//           console.log('XHR request sent');
//         }).catch(function(error) {
//           console.error('Error getting IP address:', error);
//         });
//       }
//     }
//     if (navigator.sendBeacon) {
//       window.addEventListener('unload', function() {
//         var visitorId = getVisitorId();
//         if (visitorId) {
//           getIpAddress().then(function(ipAddress) {
//             var data = {
//               visitor_id: visitorId,
//               website_id: '$trackingCode',
//               referrer: document.referrer,
//               url: window.location.href,
//               title: document.title,
//               ip_address: ipAddress,
//               session_duration: getSessionDuration(),
//               query_string_params: getQueryStringParams(),
//               screen_size: {
//                 width: window.screen.width,
//                 height: window.screen.height
//               },
//               device_type: /Mobi/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
//               operating_system: navigator.platform,
//               browser_version: navigator.userAgent
//             };
//             navigator.sendBeacon('https://app.leadrhino.io/api/tracking', JSON.stringify(data));
//           }).catch(function(error) {
//             console.error('Error getting IP address:', error);
//           });
//         }
//       });
//     } else {
//       sendTrackingDataOnEvent('beforeunload');
//     }
//     sendTrackingDataOnEvent('load');
//     sendTrackingDataOnEvent('scroll');
//     sendTrackingDataOnEvent('click');
//     debouncedSendTrackingData();
// })();
// SCRIPT;