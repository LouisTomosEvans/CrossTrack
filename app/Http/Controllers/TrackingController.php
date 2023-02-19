<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function getTrackingScript($trackingCode)
    {
        // check tracking code is in request
        if (!$trackingCode) {
            abort(403);
        }

        $trackingScript = <<<SCRIPT
        (function() {
            // function to generate a random UUID
            function generateUUID() {
                var d = new Date().getTime();
                var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = (d + Math.random() * 16) % 16 | 0;
                d = Math.floor(d / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                });
                return uuid;
            }
            
            // function to check if user agent belongs to a bot or crawler
            function isBot() {
                var botRegex = /bot|crawl|slurp|spider/i;
                return botRegex.test(navigator.userAgent);
            }
            
            // function to check if browser is headless
            function isHeadless() {
                return !window.chrome || !window.chrome.webstore || !window.chrome.webstore.install;
            }
            
            // function to get visitor ID
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
            
            // function to get IP address
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
            
            // function to get session duration
            function getSessionDuration() {
                var duration = Math.floor((Date.now() - (sessionStorage.getItem('start_time') || Date.now())) / 1000);
                sessionStorage.setItem('start_time', Date.now());
                return duration;
            }
            
            // function to extract query string parameters
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
            
            // function to send tracking data to server
            function sendTrackingData() {
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
                      var request = new XMLHttpRequest();
                      request.open('POST', 'https://example.com/tracking', true);
                      request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                      request.send(JSON.stringify(data));
                    }).catch(function(error) {
                      console.error('Error getting IP address:', error);
                    });
                  }
                }
                
                // send tracking data using beacon API if available, fallback to XHR
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
                        navigator.sendBeacon('https://example.com/tracking', JSON.stringify(data));
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
            
        })();
        SCRIPT;

        // minimize tracking script
        $trackingScript = preg_replace('/\s+/', ' ', $trackingScript);
        $trackingScript = str_replace([' { ', ' } ', ' ; ', ' : ', ' , ', ' ( ', ' ) '], ['{', '}', ';', ':', ',', '(', ')'], $trackingScript);

        
        return response($trackingScript, 200)->header('Content-Type', 'application/javascript')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
