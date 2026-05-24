<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $products = [
                            'PVC Pipe 1 inch', 'PVC Pipe 2 inch', 'PVC Pipe 3 inch', 'PVC Pipe 4 inch',
                            'Water Pipe Connector', 'Pipe Elbow Joint', 'Pipe Tee Joint', 'Pipe Reducer',
                            'Flexible Hose Pipe', 'Drain Pipe 100mm', 'Drain Pipe 150mm',
                            'Water Valve Standard', 'Ball Valve Heavy Duty', 'Check Valve',
                            'Pipe Clamp Metal', 'Pipe Clamp Plastic', 'Pipe Seal Tape',
                            'Pipe Adhesive Glue', 'Pipe End Cap', 'Pipe Union Joint',
                            'Shower Hose Flexible', 'Faucet Connector Hose',
                            'Water Filter Housing', 'Water Pump Connector',
                            'Sink Drain Kit', 'Floor Drain Cover', 'Toilet Hose Connector',
                            'Pipe Support Bracket', 'Pipe Insulation Foam',
                            'Water Pressure Regulator', 'Pipe Expansion Joint',
                            'Pipe Sleeve Protector', 'Drain Trap Kit',
                            'Water Tank Connector', 'Pipe Coupling Heavy Duty',
                            'Pipe Thread Sealant', 'Pipe Flange Set',
                            'Drain Extension Pipe', 'Pipe Cleaning Brush', 'Pipe Repair Clamp',

                            'Ceramic Floor Tile 40x40', 'Ceramic Floor Tile 60x60',
                            'Porcelain Tile Matte Finish', 'Porcelain Tile Glossy Finish',
                            'Vinyl Flooring Roll', 'Vinyl Tile Click System',
                            'Laminate Flooring Oak', 'Laminate Flooring Walnut',
                            'Engineered Wood Flooring', 'Solid Wood Flooring Panel',
                            'Floor Adhesive Standard', 'Tile Adhesive Premium',
                            'Tile Grout White', 'Tile Grout Grey', 'Tile Spacer 2mm',
                            'Tile Spacer 5mm', 'Floor Leveling Compound',
                            'Skirting Board PVC', 'Skirting Board Wood',
                            'Floor Transition Strip', 'Carpet Tile Square',
                            'Carpet Roll Standard', 'Anti Slip Floor Coating',
                            'Epoxy Floor Coating', 'Floor Polish Liquid',
                            'Tile Cutter Manual', 'Tile Cutter Heavy Duty',
                            'Floor Cleaning Solution', 'Tile Edge Trim',
                            'Underlayment Foam', 'Rubber Flooring Mat',
                            'Outdoor Deck Tile', 'Stone Tile Natural',
                            'Granite Tile Slab', 'Marble Tile Polished',
                            'Floor Expansion Joint', 'Tile Sealant',
                            'Tile Backer Board', 'Floor Protection Sheet', 'Tile Layout Marker',

                            'Electric Drill Standard', 'Cordless Drill Set',
                            'Impact Drill Heavy Duty', 'Angle Grinder 4 inch',
                            'Angle Grinder 7 inch', 'Circular Saw Machine',
                            'Jigsaw Electric', 'Rotary Hammer Drill',
                            'Screwdriver Set 10 pcs', 'Precision Screwdriver Set',
                            'Hammer Steel Head', 'Rubber Mallet',
                            'Adjustable Wrench', 'Pipe Wrench Heavy Duty',
                            'Combination Spanner Set', 'Allen Key Set',
                            'Measuring Tape 5m', 'Measuring Tape 10m',
                            'Spirit Level 60cm', 'Laser Level Tool',
                            'Utility Knife Cutter', 'Bolt Cutter Heavy Duty',
                            'Hand Saw Wood', 'Hand Saw Metal',
                            'Drill Bit Set', 'Concrete Drill Bit',
                            'Wood Drill Bit Set', 'Metal Drill Bit Set',
                            'Sanding Machine', 'Orbital Sander',
                            'Tool Box Plastic', 'Tool Box Metal',
                            'Safety Helmet', 'Safety Gloves',
                            'Safety Goggles', 'Ear Protection Muff',
                            'Work Light LED', 'Extension Cable Roll',
                            'Ladder Aluminum 6 Step', 'Ladder Aluminum 8 Step',

                            'Cement Bag 40kg', 'Cement Bag 50kg',
                            'White Cement 25kg', 'Rapid Set Cement',
                            'Mortar Mix Standard', 'Mortar Mix Premium',
                            'Concrete Mix Ready Use', 'High Strength Concrete Mix',
                            'Plastering Cement', 'Tile Fixing Mortar',
                            'Waterproof Cement Coating', 'Grout Cement',
                            'Self Leveling Cement', 'Screed Cement Mix',
                            'Masonry Cement', 'Fiber Reinforced Cement',
                            'Cement Additive Liquid', 'Cement Bonding Agent',
                            'Cement Coloring Powder', 'Quick Dry Cement',
                            'Cement Repair Compound', 'Crack Filler Cement',
                            'Cement Waterproof Additive', 'Cement Surface Hardener',
                            'Shotcrete Mix', 'Precast Concrete Mix',
                            'Cement Skim Coat', 'Cement Putty',
                            'Cement Primer Base', 'Heavy Duty Cement Mix',
                            'Lightweight Cement Mix', 'Cement Floor Hardener',
                            'Cement Grouting Mix', 'Cement Tile Adhesive',
                            'Cement Seal Coat', 'Cement Patch Repair',
                            'Cement Expansion Mix', 'Cement Joint Filler',
                            'Cement Underlayment', 'Cement Finishing Coat',

                            'Toilet Bowl Standard', 'Toilet Bowl One Piece',
                            'Toilet Seat Cover Soft Close', 'Wall Hung Toilet',
                            'Bathroom Sink Ceramic', 'Bathroom Sink Countertop',
                            'Faucet Single Lever', 'Faucet Double Handle',
                            'Shower Head Standard', 'Rain Shower Head',
                            'Shower Set Complete', 'Bathroom Mirror Standard',
                            'Bathroom Mirror LED', 'Soap Dispenser Wall Mount',
                            'Towel Rack Stainless', 'Towel Hook Set',
                            'Bathroom Cabinet Small', 'Bathroom Cabinet Large',
                            'Floor Drain Stainless', 'Floor Drain Plastic',
                            'Bidet Spray Set', 'Hand Shower Set',
                            'Water Heater Electric', 'Water Heater Gas',
                            'Bathtub Acrylic', 'Bathtub Freestanding',
                            'Shower Enclosure Glass', 'Shower Curtain Set',
                            'Toilet Brush Set', 'Toilet Paper Holder',
                            'Bathroom Shelf Glass', 'Bathroom Shelf Plastic',
                            'Sink Drain Pipe', 'Sink Trap Kit',
                            'Bathroom Exhaust Fan', 'Anti Slip Bathroom Mat',
                            'Bathroom Door PVC', 'Bathroom Door Aluminum',
                            'Wash Basin Pedestal', 'Urinal Wall Mount'
                        ];

    public function definition(): array
    {
        static $index = -1;
        $index++;

        return [
            'name' => $this->products[$index],
            'quantity' => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(50, true),
            'isActive' => true,
            'price' => fake()->numberBetween(1, 1000000)
        ];
    }
}
