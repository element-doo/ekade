# ekade.clj

Gets requests from RabbitMQ (or a similar AMQP-aware message queue) and forwards them to the email server.

## Usage

### Requirements

* JDK >= 6
* Leiningen: https://github.com/technomancy/leiningen

### Compile & Run

* lein uberjar
* java -jar target/ekade-0.1.0-SNAPSHOT-standalone.jar

## Deps

Just FYI - let leiningen take care about this.

* Postal (https://github.com/drewr/postal)
* Langohr (http://clojurerabbitmq.info/)

## License

DO WHATEVER THE FUCK YOU WANT, PUBLIC LICENSE
TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

0. You just DO WHATEVER THE FUCK YOU WANT.
