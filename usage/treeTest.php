<?php
require(__DIR__ . '/../vendor/autoload.php');

$cacheRedis = new \Dgafka\Infrastructure\Cache();

$memoryUsageWithoutNodes = memory_get_usage(true);;

$startAdding = microtime(true);
$root = new \Dgafka\Domain\Structure\RootNode();

for ($i = 0; $i < 1000; $i++) {
	$root->addChild(new \Dgafka\Domain\Structure\Node($i, 'named-' . $i));
}

for ($i = 1000; $i < 2000; $i++) {
	$parent = $i - 1000;
	$root->add(new \Dgafka\Domain\Structure\Node($i, 'named-' . $i), $parent);
}

for ($i = 2000; $i < 3000; $i++) {
	$parent = $i - 1;
	$root->add(new \Dgafka\Domain\Structure\Node($i, 'named-' . $i), $parent);
}
$finishAdding = microtime(true);

echo "Negative time for adding 3000 nodes: " . ($finishAdding - $startAdding) . "\n";

$memoryUsageWithNodes = memory_get_usage(true);;
echo "Memory usage (bytes) without nodes " . $memoryUsageWithoutNodes . " memory usage with 3000 nodes " . $memoryUsageWithNodes . " Diffrence: " . ($memoryUsageWithNodes - $memoryUsageWithoutNodes) . "\n" ;


$serialized = serialize($root);
$cacheRedis->set('structure', $serialized);

$unserializingTime = microtime(true);
$serialized = $cacheRedis->get('structure');
$root = unserialize($serialized);
$finishUnserializingTime = microtime(true);

echo "Unserializing 3000 objects time: " . ($finishUnserializingTime - $unserializingTime) . "\n";


$searchFirstLevelNegative = microtime(true);
PHPUnit_Framework_Assert::assertEquals('named-999', $root->findNodeByID(999)->name());
$finishFirstLevelNegative = microtime(true);

echo "Negative time for searching in 1000 nodes in first level: " . ($finishFirstLevelNegative - $searchFirstLevelNegative) . "\n";



$searchNegativeDeepNode = microtime(true);
PHPUnit_Framework_Assert::assertEquals('named-2999', $root->findNodeByID(2999)->name());
$finishNegativeDeepNode = microtime(true);

echo "Negative time for searching in 3000 nodes in deep levels: " . ($finishNegativeDeepNode - $searchFirstLevelNegative) . "\n";
