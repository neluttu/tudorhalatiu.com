<?
use Core\SchemaGenerator;
$schema = new SchemaGenerator('About.json');
$schema = $schema->generateSchema();

view('about', [
    'heading' => Core\Lang::text('heading.about.0'),
    'heading_info' => Core\Lang::text('heading.about.1'),
    'title' => 'Povestea din spatele brandului Tudor Halațiu',
    'description' => 'Descopera povestea din spatele brandului Tudor Halatiu, sursa de inspiratie, dar si perspectiva de viitor a brandului.',
    'schema' => $schema

]);
