<?php


use CodeIgniter\HTTP\IncomingRequest;

function requestKWR(): array
{
    $requestInfo = [];
    $request = service('request');

    $requestInfo["ALL_HEADERS"] = $request->getHeaders();
    $requestInfo["PATH"] = $request->getUri()->getPath();
    $requestInfo["BODY"] = $request->getJSON();
    $requestInfo["SERVER"] = $request->getServer();
    $requestInfo["HOST"] = $request->getHeaderLine('host');
    $requestInfo["AUTH"] = $request->headers();
    $requestInfo["BASIC_AUTH"] = $request->getHeaderLine('Authorization');
    $requestInfo["HEADER_CONTENT"] = $request->getHeader('Content-Type');
    $requestInfo["METHOD"] = $request->getMethod();

    return $requestInfo;
}
