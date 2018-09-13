<?php
/**
 * Copyright 2018 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/bigquery/api/README.md
 */

// Include Google Cloud dependendencies using Composer
require_once __DIR__ . '/../vendor/autoload.php';

if (count($argv) < 4 || count($argv) > 5) {
    return print("Usage: php snippets/paginate_table.php PROJECT_ID DATASET_ID TABLE_ID [NUM_RESULTS]\n");
}
list($_, $projectId, $datasetId, $tableId) = $argv;
$maxResults = isset($argv[4]) ? $argv[4] : 10;

/** Uncomment and populate these variables in your code */
// $projectId = 'The Google project ID';
// $datasetId = 'The BigQuery dataset ID';
// $tableId   = 'The BigQuery table ID';
// $maxResults = 10;

$totalRows = 0;
// Function to determine if we should keep paginating
$shouldPaginateFunc = function () {
    return true;
};

do {
    $rows = require 'browse_table.php';
    $totalRows += $rows;
} while ($rows && 0 === $totalRows % $maxResults && $shouldPaginateFunc());
return $totalRows;
