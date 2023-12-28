<?php

// Originator: Student class represents a student and manages enrollment details
class Student
{
    private $name;
    private $enrollmentDetails;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setEnrollmentDetails($details)
    {
        $this->enrollmentDetails = $details;
    }

    public function getEnrollmentDetails()
    {
        return $this->enrollmentDetails;
    }

    public function createMemento()
    {
        return new EnrollmentMemento($this->enrollmentDetails);
    }

    public function restoreFromMemento(EnrollmentMemento $memento)
    {
        $this->enrollmentDetails = $memento->getEnrollmentDetails();
    }
}

// Memento: EnrollmentMemento represents a snapshot of the student's enrollment state
class EnrollmentMemento
{
    private $enrollmentDetails;

    public function __construct($details)
    {
        $this->enrollmentDetails = $details;
    }

    public function getEnrollmentDetails()
    {
        return $this->enrollmentDetails;
    }
}

// Caretaker: EnrollmentHistory manages a history of enrollment states
class EnrollmentHistory
{
    private $mementos = [];

    public function addMemento(EnrollmentMemento $memento)
    {
        $this->mementos[] = $memento;
    }

    public function getMemento($index)
    {
        return $this->mementos[$index];
    }
}

// Example usage:

// Create a student
$student = new Student("John Doe");

// Set initial enrollment details
$student->setEnrollmentDetails("Enrolled in Computer Science");

// Create a history to store enrollment states
$history = new EnrollmentHistory();

// Save the initial state
$history->addMemento($student->createMemento());

// Modify enrollment details
$student->setEnrollmentDetails("Enrolled in Mathematics");

// Save the modified state
$history->addMemento($student->createMemento());

// Restore to the initial state
$student->restoreFromMemento($history->getMemento(0));

echo "Current Enrollment: " . $student->getEnrollmentDetails(); // Output: Enrolled in Computer Science