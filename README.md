<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## The Publisher

For this challege we'll be creating a HTTP notification.

A server (or set of servers) will keep track of topics -> subscriber where a topic is a string and a subscriber is an HTTP endpoint. When a message is published on a topic, it should be forwarded to all subscriber endpoints.

##### Prerequisite:
- [Laravel Framework 9.41.0](https://laravel.com).
- [Postman](https://www.postman.com/).
- [Google Cloud PubSub](https://cloud.google.com/pubsub/docs/overview).

##### Alternative for Google Cloud PubSub

- [Redis](https://redis.io/).

##### Disclaimer: 
Since there is not specification of tools to use I presume you guys will prefer using Google Cloud PubSub.
##### How to setup this app

- Clone this app by copy this command and run it in your terminal `git clone https://github.com/webcodedsoft/maxibuy.git`

then cd into `maxibuy` directory by using `cd maxibuy`.

and run `composer install` to install the dependencies and after you successfully install the dependencies you can now run `php artisan serve`

**Note:**
I already add the Google Cloud PubSub into `storage/app`.

So in this app we have two endpoints `publish` && `subscribe`

**Publish**
The `publish` endpoint is meant for publishing data to the subscriber that subscribe to the topic this endpoint expecting two types of datas one is `params` and request `body` where `params` is string that contain `topic` the subscriber subscribe to and the `body` contain the additional data of any types.

**Subscribe**

The `subscribe` endpoint is meant for receiving data the `publish` endpoint **published** also this endpoint expecting two types of datas one is `params` and request `body` where `params` is string that contain `topic` the subscriber subscribe to and the `body` contain the additional data which is `url` and must be a valid url.

Thanks
Kindly revert back if their is any challenege 
