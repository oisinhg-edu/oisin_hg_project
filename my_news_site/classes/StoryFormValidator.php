<?php
class StoryFormValidator extends FormValidator
{

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function validate()
    {

        // validate the form fields, placing any error messages in
        // $this->errors array

        // headline
        if (!$this->isPresent("headline")) {
            $this->errors['headline'] = "You must enter a headline";
        } else if (!$this->minLength("headline", 10)) {
            $this->errors['headline'] = "Headline must be at least 10 characters";
        }

        // short headline
        if (!$this->isPresent("short_headline")) {
            $this->errors["short_headline"] = "You must enter a short headline";
        }

        // article
        if (!$this->isPresent("article")) {
            $this->errors['article'] = "You must enter an article";
        } else if (!$this->minLength("article", 10)) {
            $this->errors['article'] = "Article must be at least 10 characters";
        }

        // image
        if (!$this->isPresent("img_url")) {
            $this->errors["img_url"] = "You must enter an image name";
        } else if (!$this->isMatch("img_url", '/^(.*)(\.gif|\.jpg|\.jpeg|\.png)$/')) {
            $this->errors['img_url'] = "Invalid file type";
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

        // creation date
        // if (!$this->isMatch("created_at", "/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/")) {
        //     $this->errors['created_at'] = 'INTERNAL ERROR created_at';
        // }

        // updated date
        // if (!$this->isMatch("updated_at", "/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/")) {
        //     $this->errors['updated_at'] = 'INTERNAL ERROR updated_at';
        // }

        return count($this->errors) === 0;
    }
}

?>