<?php 
class StoryFormValidator extends FormValidator {

    public function __construct($data = []) {
        parent::__construct($data);
    }

    public function validate() {

        // validate the form fields, placing any error messages in
        // $this->errors array

        // headline
        if (!$this->isPresent("headline")) {
            $this->errors['headline'] = "You must enter a headline";
        }
        else if (!$this->minLength("headline", 10)){
            $this->errors['headline'] = "Headline must be at least 10 characters";
        }

        // article
        if (!$this->isPresent("article")) {
            $this->errors['article'] = "You must enter an article";
        }
        else if (!$this->minLength("article", 10)){
            $this->errors['article'] = "Article must be at least 10 characters";
        }

        // author
        if (!$this->isPresent("author_id")) {
            $this->errors['author_id'] = "You must choose an author";
        }

        // category
        if (!$this->isPresent("category_id")) {
            $this->errors['category_id'] = "You must choose a category";
        }

        // location
        if (!$this->isPresent("location_id")) {
            $this->errors['location_id'] = "You must choose a location";
        }

        return count($this->errors) === 0;
    }
}

?>
