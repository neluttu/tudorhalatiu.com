<?
use Core\SchemaGenerator;
$schema = new SchemaGenerator('ContactPage.json');
$schema = $schema->generateSchema([]);


view('contact',[
    'heading' => Core\Lang::text('heading.contact.0'),
    'heading_info' => Core\Lang::text('heading.contact.1'),
    'title' => 'Informații contact magazin online Tudor Halațiu',
    'description' => 'Fii aproape de echipa TUDOR HALATIU și contactează-ne pentru o experiență completă, dar și pentru informațiile suplimentare cu privirea la creațiile de pe site.',
    'schema' => $schema
]);