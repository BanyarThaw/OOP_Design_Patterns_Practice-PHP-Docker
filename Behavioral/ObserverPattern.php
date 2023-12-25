<?php
    class NewsPublisher { // The Publisher
        private $subscribers = [];
    
        public function attach(NewsSubscriber $subscriber) {
            $this->subscribers[] = $subscriber;
        }
    
        public function detach(NewsSubscriber $subscriber) {
            $key = array_search($subscriber, $this->subscribers, true);
            if ($key !== false) {
                unset($this->subscribers[$key]);
            }
        }
    
        public function notify($category, $article) {
            foreach ($this->subscribers as $subscriber) {
                $subscriber->update($category, $article);
            }
        }
    }
    
    class NewsSubscriber { // The Subscriber
        private $name;
    
        public function __construct($name) {
            $this->name = $name;
        }
    
        public function update($category, $article) {
            echo "[$this->name] New article in $category: $article\n";
        }
    }
    
    // Client Code
    $publisher = new NewsPublisher();
    
    $subscriber1 = new NewsSubscriber("Alice");
    $subscriber2 = new NewsSubscriber("Bob");
    $subscriber3 = new NewsSubscriber("Charlie");
    
    $publisher->attach($subscriber1);
    $publisher->attach($subscriber2);
    $publisher->attach($subscriber3);
    
    $publisher->notify("politics", "New tax law passed");
    $publisher->notify("sports", "New football championship announced");
    
    $publisher->detach($subscriber2); // detaching
    
    $publisher->notify("entertainment", "New movie release announced");
?>