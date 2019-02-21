# proxy-nginx-cache-test

## Installation

Create needed files

```
touch .env
cp docker-compose.override.yml.dist docker-compose.override.yml
```

Start php-cli (other containers will be started)
```
docker-compose run --rm php-cli
```

Inside the php-cli container install composer packages
```
composer install
```

## Environments

The proxy url is available under `http://localhost:10080` and the url to the php app is available under `http://localhost:20080` 

The branch `master` contains a simple php script.

The branch `symfony` contains my test scenario with symfony.

## The problem

If i use the simple php script variant, all looks fine. A call through the proxy creates a cache hit.

```
# first call to nginx
curl -is http://localhost:20080/bar
HTTP/1.1 200 OK
Server: nginx/1.13.5
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.2.14
Cache-Control: public
Date: Thu, 21 Feb 2019 07:12:45 GMT
Expires: Thu, 21 Feb 2019 07:13:05 GMT
X-Cache: MISS

/bar time(1550733165)

# second call to nginx
curl -is http://localhost:20080/bar
HTTP/1.1 200 OK
Server: nginx/1.13.5
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.2.14
Cache-Control: public
Date: Thu, 21 Feb 2019 07:12:45 GMT
Expires: Thu, 21 Feb 2019 07:13:05 GMT
X-Cache: HIT

/bar time(1550733165)

```

If symfony is used, the call through the proxy does not create a cache hit.

```
# first call to proxy
curl -is http://localhost:10080/foo
HTTP/1.1 200 OK
Server: nginx/1.13.5
Date: Thu, 21 Feb 2019 07:14:16 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.2.14
Cache-Control: public
pragma: no-cache
expires: -1
X-Cache: MISS

/foo time(1550733256)

# second call to proxy
curl -is http://localhost:10080/foo
HTTP/1.1 200 OK
Server: nginx/1.13.5
Date: Thu, 21 Feb 2019 07:14:27 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.2.14
Cache-Control: public
pragma: no-cache
expires: -1
X-Cache: MISS

/foo time(1550733267)
```







