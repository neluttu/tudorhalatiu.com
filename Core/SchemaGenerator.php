<?
namespace Core;

class SchemaGenerator {
    private $templatePath;

    public function __construct($templatePath) {
        $this->templatePath = base_path() . 'Http/Schema/' . $templatePath;
    }

    public function generateSchema($data = []): string {
        if (!file_exists($this->templatePath)) 
            throw new \Exception('Fișierul șablon nu există: ' . $this->templatePath);
        
        $templateContent = '<script type="application/ld+json">';
        $templateContent .= file_get_contents($this->templatePath);
        if(count($data) > 0)
            foreach ($data as $key => $value) {
                $variable = '{{' . $key . '}}';
                $templateContent = str_replace($variable, $value, $templateContent);
            }
        $templateContent .= '
    </script>
';
        return $templateContent;
    }
}