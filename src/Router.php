<?php
namespace App;
class Router {
    // Requested page
    public string $page_request = '';

    public function Listen ($url) {
        // Get current page url (Requested URL)
        $current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Take the domain and protocol off leaving the route behind
        $this->page_request = str_replace($url, '', $current_url);

        // Remove any stranded `/`
        $this->page_request = str_replace('/', '', $this->page_request); //NEEDS FIX

        // Lower page request
        $this->page_request = strtolower($this->page_request);

        // Display route content from template
        $this->Display($this->page_request);
    }

    public function Display ($route) {
        // * Search through templates with template prefix and display if found

        // Save directory where templates will be found
        $template_dir = 'templates';

        // Get list of files with `.php` extension from template dir
        $template_files = glob($template_dir.'/*.php');#

        // Loop through template_files array
        for ($i = 0; $i < count($template_files); $i++) {
            // If template = page request name declare to variable
            if ($template_files[$i] == $template_dir.'/'.$this->page_request.'.php') {
                // Assign the path of the file to variable if its true else continue with loop
                $file = $template_files[$i];
            } else continue;

        }
        // If the file variable has value include template code
        if (isset($file)) {
            include ''.$file.'';
        }
        
    }
}
