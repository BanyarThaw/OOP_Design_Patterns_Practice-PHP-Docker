<?php
    // Abstraction
    interface Shape {
        // Abstraction provides a method for drawing, relying on an implementation.
        public function draw();
    }

    // Implementor
    interface DrawingAPI {
        // Implementor provides an interface for drawing methods.
        public function drawCircle($x, $y, $radius);
        public function drawSquare($x, $y, $side);
    }
    // Concrete Implementor 1
    class SVGDrawingAPI implements DrawingAPI {
        public function drawCircle($x, $y, $radius) {
            return "Drawing a circle in SVG at ($x, $y) with radius $radius";
        }

        public function drawSquare($x, $y, $side) {
            return "Drawing a square in SVG at ($x, $y) with side $side";
        }
    }

    // Concrete Implementor 2
    class CanvasDrawingAPI implements DrawingAPI {
        public function drawCircle($x, $y, $radius) {
            return "Drawing a circle on Canvas at ($x, $y) with radius $radius";
        }

        public function drawSquare($x, $y, $side) {
            return "Drawing a square on Canvas at ($x, $y) with side $side";
        }
    }

    // Refined Abstraction 1
    class Circle implements Shape {
        private $drawingAPI;

        public function __construct(DrawingAPI $drawingAPI) {
            $this->drawingAPI = $drawingAPI;
        }

        public function draw() {
            return $this->drawingAPI->drawCircle(0, 0, 5);
        }
    }

    // Refined Abstraction 2
    class Square implements Shape {
        private $drawingAPI;

        public function __construct(DrawingAPI $drawingAPI) {
            $this->drawingAPI = $drawingAPI;
        }

        public function draw() {
            return $this->drawingAPI->drawSquare(0, 0, 10);
        }
    }

    // Client Code
    $svgDrawingAPI = new SVGDrawingAPI();
    $canvasDrawingAPI = new CanvasDrawingAPI();

    $circleSVG = new Circle($svgDrawingAPI);
    $squareCanvas = new Square($canvasDrawingAPI);

    echo $circleSVG->draw(); // Output: Drawing a circle in SVG at (0, 0) with radius 5
    echo "\n";
    echo $squareCanvas->draw(); // Output: Drawing a square on Canvas at (0, 0) with side 10
?>