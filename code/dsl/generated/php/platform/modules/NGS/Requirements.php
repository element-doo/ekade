<?php
require_once __DIR__.'/BigDecimal.php';
require_once __DIR__.'/BigInt.php';
require_once __DIR__.'/ByteStream.php';
require_once __DIR__.'/LocalDate.php';
require_once __DIR__.'/Money.php';
require_once __DIR__.'/Name.php';
require_once __DIR__.'/Timestamp.php';
require_once __DIR__.'/Utils.php';
require_once __DIR__.'/UUID.php';
require_once __DIR__.'/S3.php';
require_once __DIR__.'/Location.php';
require_once __DIR__.'/Point.php';

require_once __DIR__.'/Client/Exception/InvalidRequestException.php';
require_once __DIR__.'/Client/Exception/NotFoundException.php';
require_once __DIR__.'/Client/Exception/RequestException.php';
require_once __DIR__.'/Client/Exception/SecurityException.php';
require_once __DIR__.'/Client/Exception/ClientErrorException.php';
require_once __DIR__.'/Client/Exception/ServerErrorException.php';

require_once __DIR__.'/Client/ApplicationProxy.php';
require_once __DIR__.'/Client/CrudProxy.php';
require_once __DIR__.'/Client/DomainProxy.php';
require_once __DIR__.'/Client/HttpRequest.php';
require_once __DIR__.'/Client/ReportingProxy.php';
require_once __DIR__.'/Client/RestHttp.php';
require_once __DIR__.'/Client/StandardProxy.php';

require_once __DIR__.'/Converter/ConverterInterface.php';
require_once __DIR__.'/Converter/PrimitiveConverter.php';
require_once __DIR__.'/Converter/BigDecimalConverter.php';
require_once __DIR__.'/Converter/BigIntConverter.php';
require_once __DIR__.'/Converter/ByteStreamConverter.php';
require_once __DIR__.'/Converter/LocalDateConverter.php';
require_once __DIR__.'/Converter/MoneyConverter.php';
require_once __DIR__.'/Converter/ObjectConverter.php';
require_once __DIR__.'/Converter/TimestampConverter.php';
require_once __DIR__.'/Converter/UUIDConverter.php';
require_once __DIR__.'/Converter/XmlConverter.php';

require_once __DIR__.'/Patterns/IIdentifiable.php';
require_once __DIR__.'/Patterns/IDomainObject.php';
require_once __DIR__.'/Patterns/Searchable.php';
require_once __DIR__.'/Patterns/Identifiable.php';
require_once __DIR__.'/Patterns/Search.php';
require_once __DIR__.'/Patterns/SearchBuilder.php';
require_once __DIR__.'/Patterns/GenericSearch.php';
require_once __DIR__.'/Patterns/AggregateRoot.php';
require_once __DIR__.'/Patterns/AggregateDomainEvent.php';
require_once __DIR__.'/Patterns/DomainEvent.php';
require_once __DIR__.'/Patterns/Snapshot.php';
require_once __DIR__.'/Patterns/Specification.php';
require_once __DIR__.'/Patterns/SearchBuilder.php';
require_once __DIR__.'/Patterns/Templater.php';
require_once __DIR__.'/Patterns/OlapCube.php';
require_once __DIR__.'/Patterns/CubeBuilder.php';
