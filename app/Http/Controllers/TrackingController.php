<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visits;

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
                if (!isBot() && !isHeadless()) {
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
                      var date = new Date();
                      date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // cookie expires in 30 days
                      var expires = "expires="+date.toUTCString();
                      document.cookie = "visitor_id=" + visitorId + ";" + expires + ";path=/";
                  }
                }
                return visitorId;
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
              console.log("sendTrackingData() called");
              var visitorId = getVisitorId();
              if (visitorId) {
                console.log('Visitor ID:', visitorId);
                getIpAddress().then(function(ipAddress) {
                  var data = {
                    visitor_id: visitorId,
                    website_id: '$trackingCode',
                    referrer: document.referrer,
                    url: window.location.href,
                    title: document.title,
                    ip_address: ipAddress,
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
                  console.log('Data:', data);
                  var request = new XMLHttpRequest();
                  request.open('POST', 'https://app.leadrhino.io/tracking', true);
                  request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                  request.send(JSON.stringify(data));
                  console.log('XHR request sent');
                }).catch(function(error) {
                  console.error('Error getting IP address:', error);
                });
              }
            }
            if (navigator.sendBeacon) {
              window.addEventListener('unload', function() {
                var visitorId = getVisitorId();
                if (visitorId) {
                  getIpAddress().then(function(ipAddress) {
                    var data = {
                      visitor_id: visitorId,
                      website_id: '$trackingCode',
                      referrer: document.referrer,
                      url: window.location.href,
                      title: document.title,
                      ip_address: ipAddress,
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
                    navigator.sendBeacon('https://app.leadrhino.io/tracking', JSON.stringify(data));
                  }).catch(function(error) {
                    console.error('Error getting IP address:', error);
                  });
                }
              });
            } else {
              window.addEventListener('beforeunload', function() {
                sendTrackingData();
              });
            }
            window.sendTrackingData = sendTrackingData;
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
        $data['screen_size'] = json_encode($data['screen_size']);
        $data['device_type'] = $data['device_type'] ?? 'unknown';
        $data['operating_system'] = $data['operating_system'] ?? 'unknown';
        $data['browser_version'] = $data['browser_version'] ?? 'unknown';
        $data['referrer'] = $data['referrer'] ?? 'unknown';
        $data['url'] = $data['url'] ?? 'unknown';
        $data['title'] = $data['title'] ?? 'unknown';
        $website_id = $data['website_id'] ?? 'unknown';
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        // get website from tracking code
        $website = Website::where('tracking_code', $website_id)->first();
        if ($website) {
            $data['website_id'] = $website->id;
        } else {
            // error if website not found abort(404);
            abort(404, 'Website not found');
        }

        // check the route of the website domain is the same as the request domain add fuzziness for http/https
        if (!str_contains($website->domain, $domain) || !str_contains($domain, $website->domain)) {
            // error if website domain does not match request domain
            abort(404, 'Traffic not from correct domain');
        }
        
        Visits::create($data);
        return response()->json(['success' => true]);
    }
}
