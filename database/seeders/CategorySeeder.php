<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            [
                'name' => 'Market',
                'children' => [
                    ['name' => 'Baby & Kids Stuffs'],
                    ['name' => 'Cameras & Studio Equipment'],
                    ['name' => 'Clothing & Accessories'],
                    ['name' => 'Computer & Software'],
                    ['name' => 'Games & Consoles'],
                    ['name' => 'Home & Garden'],
                    ['name' => 'Musical Instruments'],
                    ['name' => 'Others'],
                    ['name' => 'Pets'],
                    ['name' => 'Sports & Travels'],
                    ['name' => 'Tickets'],
                    ['name' => 'Tools & Appliances'],
                    ['name' => 'Mobile Accessories', 'is_featured' => true, 'icon' => 'mobile'],
                    ['name' => 'Hygiene Essentials', 'is_featured' => true, 'icon' => 'hotel'],
                    ['name' => 'Accounting', 'is_featured' => true, 'icon' => 'file-invoice'],
                    [
                        'name' => 'Women\'s Fashion', 'is_featured' => true, 'icon' => 'female',
                        'children' => [
                            ['name' => 'Dresses'],
                            ['name' => 'T-shirt & Singlets'],
                            ['name' => 'Skirts'],
                            ['name' => 'Coats & Jackets'],
                            ['name' => 'Jeans'],
                            ['name' => 'Tops'],
                            ['name' => 'Shorts'],
                            ['name' => 'Pants'],
                            ['name' => 'Sweats & Hoodies'],
                            ['name' => 'One Piece'],
                            ['name' => 'Jumpers'],
                            ['name' => 'Wedding Dresses'],
                            ['name' => 'Party Wear'],
                            ['name' => 'Casual Wear'],
                            ['name' => 'Wrist Bands'],
                            ['name' => 'Gym Tights'],
                            ['name' => 'Boots'],
                            ['name' => 'Shoe'],
                            ['name' => 'Lifestyle Shoes'],
                            ['name' => 'Performance Shoe'],
                            ['name' => 'High Heels'],
                            ['name' => 'Headwear'],
                            ['name' => 'Watches'],
                            ['name' => 'Underwear & Socks'],
                            ['name' => 'Perfume'],
                            ['name' => 'Jewellery'],
                            ['name' => 'Sunglasses'],
                        ]
                    ],
                    [
                        'name' => 'Men\'s Fashion', 'is_featured' => true, 'icon' => 'tshirt',
                        'children' => [
                            ['name' => 'Shirts & Polo'],
                            ['name' => 'Pants'],
                            ['name' => 'Jacket & Coat'],
                            ['name' => 'Shoe'],
                        ]
                    ],
                    ['name' => 'Arts & Collections', 'is_featured' => true, 'icon' => 'palette'],
                    ['name' => 'Audio & Stereo', 'is_featured' => true, 'icon' => 'volume-up'],
                    ['name' => 'Electronics', 'is_featured' => true, 'icon' => 'robot'],
                    ['name' => 'Fishing & Hunting', 'is_featured' => true, 'icon' => 'fish'],
                    ['name' => 'Furniture', 'is_featured' => true, 'icon' => 'chair'],
                ]
            ], // 1
            [
                'name' => 'Services',
                'children' => [
                    ['name' => 'Child care & Nanny'],
                    ['name' => 'Cleaners & Cleaning'],
                    ['name' => 'Entertainment'],
                    ['name' => 'Financial & Legal'],
                    ['name' => 'Fitness & Personal Trainer'],
                    ['name' => 'Foods & Catering'],
                    ['name' => 'Health & Beauty'],
                    ['name' => 'Moving & Storage'],
                    ['name' => 'Music Lessons'],
                    ['name' => 'Photography & Video'],
                    ['name' => 'Property & Maintenance'],
                    ['name' => 'Tutors & Languages'],
                    ['name' => 'Wedding'],
                    ['name' => 'Travel & Vacations'],
                    ['name' => 'Others'],
                    ['name' => 'Personal Care', 'is_featured' => true, 'icon' => 'hand-holding-medical'],
                    ['name' => 'Business & Industrial', 'is_featured' => true, 'icon' => 'industry'],
                ]
            ], // 2
            [
                'name' => 'Jobs',
                'children' => [
                    [
                        'name' => 'Administrative',
                        'children' => [
                            ['name' => 'Administrative Assistant'],
                            ['name' => 'Receptionist'],
                            ['name' => 'Office Manager'],
                            ['name' => 'Auditing Clerk'],
                            ['name' => 'Bookkeeper'],
                            ['name' => 'Account Executive'],
                            ['name' => 'Branch Manager'],
                            ['name' => 'Business Manager'],
                            ['name' => 'Quality Control Coordinator'],
                            ['name' => 'Administrative Manager'],
                            ['name' => 'Chief Executive Officer'],
                            ['name' => 'Business Analyst'],
                            ['name' => 'Risk Manager'],
                            ['name' => 'Human Resources'],
                            ['name' => 'Office Assistant'],
                            ['name' => 'Secretary'],
                            ['name' => 'Office Clerk'],
                            ['name' => 'File Clerk'],
                            ['name' => 'Account Collector'],
                            ['name' => 'Administrative Specialist'],
                            ['name' => 'Executive Assistant'],
                            ['name' => 'Program Administrator'],
                            ['name' => 'Program Manager'],
                            ['name' => 'Administrative Analyst'],
                            ['name' => 'Data Entry'],
                        ]
                    ],
                    [
                        'name' => 'Information Technology',
                        'children' => [
                            ['name' => 'Computer Scientist'],
                            ['name' => 'IT Professional'],
                            ['name' => 'UX Designer & UI Developer'],
                            ['name' => 'SQL Developer'],
                            ['name' => 'Web Designer'],
                            ['name' => 'Web Developer'],
                            ['name' => 'Help Desk Worker/Desktop Support'],
                            ['name' => 'Software Engineer'],
                            ['name' => 'Data Entry'],
                            ['name' => 'DevOps Engineer'],
                            ['name' => 'Computer Programmer'],
                            ['name' => 'Network Administrator'],
                            ['name' => 'Information Security Analyst'],
                            ['name' => 'Artificial Intelligence Engineer'],
                            ['name' => 'Cloud Architect'],
                            ['name' => 'IT Manager'],
                            ['name' => 'Technical Specialist'],
                            ['name' => 'Application Developer'],
                            ['name' => 'Chief Technology Officer (CTO)'],
                            ['name' => 'Chief Information Officer (CIO)'],
                        ]
                    ],
                    [
                        'name' => 'Management and Leadership',
                        'children' => [
                            ['name' => 'Team Leader'],
                            ['name' => 'Manager'],
                            ['name' => 'Assistant Manager'],
                            ['name' => 'Executive'],
                            ['name' => 'Director'],
                            ['name' => 'Coordinator'],
                            ['name' => 'Administrator'],
                            ['name' => 'Controller'],
                            ['name' => 'Officer'],
                            ['name' => 'Organizer'],
                            ['name' => 'Supervisor'],
                            ['name' => 'Superintendent'],
                            ['name' => 'Head'],
                            ['name' => 'Overseer'],
                            ['name' => 'Chief'],
                            ['name' => 'Foreman'],
                            ['name' => 'Controller'],
                            ['name' => 'Principal'],
                            ['name' => 'President'],
                            ['name' => 'Lead'],
                        ]
                    ],
                    [
                        'name' => 'Marketing',
                        'children' => [
                            ['name' => 'Marketing Specialist'],
                            ['name' => 'Marketing Manager'],
                            ['name' => 'Marketing Director'],
                            ['name' => 'Graphic Designer'],
                            ['name' => 'Marketing Research Analyst'],
                            ['name' => 'Marketing Communications Manager'],
                            ['name' => 'Marketing Consultant'],
                            ['name' => 'Product Manager'],
                            ['name' => 'Public Relations'],
                            ['name' => 'Social Media Assistant'],
                            ['name' => 'Brand Manager'],
                            ['name' => 'SEO Manager'],
                            ['name' => 'Content Marketing Manager'],
                            ['name' => 'Copywriter'],
                            ['name' => 'Media Buyer'],
                            ['name' => 'Digital Marketing Manager'],
                            ['name' => 'Commerce Marketing Specialist'],
                            ['name' => 'Brand Strategist'],
                            ['name' => 'Vice President of Marketing'],
                            ['name' => 'Media Relations Coordinator'],
                        ]],
                    [
                        'name' => 'Other jobs',
                        'children' => [
                            ['name' => 'Archivist'],
                            ['name' => 'Actuary'],
                            ['name' => 'Architect'],
                            ['name' => 'Personal Assistant'],
                            ['name' => 'Entrepreneur'],
                            ['name' => 'Security Guard'],
                            ['name' => 'Mechanic'],
                            ['name' => 'Recruiter'],
                            ['name' => 'Mathematician'],
                            ['name' => 'Locksmith'],
                            ['name' => 'Management Consultant'],
                            ['name' => 'Shelf Stocker'],
                            ['name' => 'Caretaker or House Sitter'],
                            ['name' => 'Library Assistant'],
                            ['name' => 'Translator'],
                            ['name' => 'HVAC Technician'],
                            ['name' => 'Attorney'],
                            ['name' => 'Paralegal'],
                            ['name' => 'Executive Assistant'],
                            ['name' => 'Personal Assistant'],
                            ['name' => 'Bank Teller'],
                            ['name' => 'Parking Attendant'],
                            ['name' => 'Machinery Operator'],
                            ['name' => 'Manufacturing Assembler'],
                            ['name' => 'Funeral Attendant'],
                            ['name' => 'Assistant Golf Professional'],
                            ['name' => 'Yoga Instructor'],
                        ]
                    ],
                    [
                        'name' => 'Teaching',
                        'children' => [
                            ['name' => 'Mentor'],
                            ['name' => 'Tutor/Online Tutor'],
                            ['name' => 'Teacher'],
                            ['name' => 'Teaching Assistant'],
                            ['name' => 'Substitute Teacher'],
                            ['name' => 'Preschool Teacher'],
                            ['name' => 'Test Scorer'],
                            ['name' => 'Online ESL Instructor'],
                            ['name' => 'Professor'],
                            ['name' => 'Assistant Professor'],
                        ]
                    ],
                    [
                        'name' => 'Engineering',
                        'children' => [
                            ['name' => 'Engineer'],
                            ['name' => 'Mechanical Engineer'],
                            ['name' => 'Civil Engineer'],
                            ['name' => 'Electrical Engineer'],
                            ['name' => 'Assistant Engineer'],
                            ['name' => 'Chemical Engineer'],
                            ['name' => 'Chief Engineer'],
                            ['name' => 'Drafter'],
                            ['name' => 'Engineering Technician'],
                            ['name' => 'Geological Engineer'],
                            ['name' => 'Biological Engineer'],
                            ['name' => 'Maintenance Engineer'],
                            ['name' => 'Mining Engineer'],
                            ['name' => 'Nuclear Engineer'],
                            ['name' => 'Petroleum Engineer'],
                            ['name' => 'Quality Engineer'],
                            ['name' => 'Safety Engineer'],
                            ['name' => 'Sales Engineer'],
                        ]
                    ],
                    [
                        'name' => 'Health care',
                        'children' => [
                            ['name' => 'Travel Nurse'],
                            ['name' => 'Nurse Practitioner'],
                            ['name' => 'Doctor'],
                            ['name' => 'Caregiver'],
                            ['name' => 'CNA'],
                            ['name' => 'Physical Therapist'],
                            ['name' => 'Pharmacist'],
                            ['name' => 'Pharmacy Assistant'],
                            ['name' => 'Medical Administrator'],
                            ['name' => 'Medical Laboratory Tech'],
                            ['name' => 'Physical Therapy Assistant'],
                            ['name' => 'Massage Therapy'],
                            ['name' => 'Dental Hygienist'],
                            ['name' => 'Orderly'],
                            ['name' => 'Personal Trainer'],
                            ['name' => 'Massage Therapy'],
                            ['name' => 'Medical Laboratory Tech'],
                            ['name' => 'Phlebotomist'],
                            ['name' => 'Medical Transcriptionist'],
                            ['name' => 'Telework Nurse/Doctor'],
                            ['name' => 'Reiki Practitioner'],
                        ]
                    ],
                    [
                        'name' => 'Cosmetology',
                        'children' => [
                            ['name' => 'Beautician'],
                            ['name' => 'Hair Stylist'],
                            ['name' => 'Nail Technician'],
                            ['name' => 'Cosmetologist'],
                            ['name' => 'Salon Manager'],
                            ['name' => 'Makeup Artist'],
                            ['name' => 'Aesthetician'],
                            ['name' => 'Skin Care Specialist'],
                            ['name' => 'Manicurist'],
                            ['name' => 'Barber'],
                        ]
                    ],
                    [
                        'name' => 'Counselling jobs',
                        'children' => [
                            ['name' => 'Abroad studies Counselor'],
                            ['name' => 'Mental Health Counselor'],
                            ['name' => 'Addiction Counselor'],
                            ['name' => 'School Counselor '],
                            ['name' => 'Speech Pathologist'],
                            ['name' => 'Guidance Counselor'],
                            ['name' => 'Social Worker'],
                            ['name' => 'Therapist'],
                            ['name' => 'Life Coach'],
                            ['name' => 'Couples Counselor'],
                        ]
                    ],
                    [
                        'name' => 'Restaurant and Hospitality',
                        'children' => [
                            ['name' => 'Housekeeper'],
                            ['name' => 'Flight Attendant'],
                            ['name' => 'Travel Agent'],
                            ['name' => 'Hotel Front Door Greeter'],
                            ['name' => 'Bellhop'],
                            ['name' => 'Cruise Director'],
                            ['name' => 'Entertainment Specialist'],
                            ['name' => 'Hotel Manager'],
                            ['name' => 'Front Desk Associate'],
                            ['name' => 'Concierge'],
                            ['name' => 'Group Sales'],
                            ['name' => 'Event Planner'],
                            ['name' => 'Porter'],
                            ['name' => 'Spa Manager'],
                            ['name' => 'Wedding Coordinator'],
                            ['name' => 'Cruise Ship Attendant'],
                            ['name' => 'Casino Host'],
                            ['name' => 'Hotel Receptionist'],
                            ['name' => 'Reservationist'],
                            ['name' => 'Events Manager'],
                            ['name' => 'Meeting Planner'],
                            ['name' => 'Lodging Manager'],
                            ['name' => 'Director of Maintenance'],
                            ['name' => 'Valet'],
                            ['name' => 'Waiter/Waitress'],
                            ['name' => 'Server'],
                            ['name' => 'Chef'],
                            ['name' => 'Fast Food Worker'],
                            ['name' => 'Barista'],
                            ['name' => 'Line Cook'],
                            ['name' => 'Cafeteria Worker'],
                            ['name' => 'Restaurant Manager'],
                            ['name' => 'Wait Staff Manager'],
                            ['name' => 'Bus Person'],
                            ['name' => 'Restaurant Chain Executive'],
                        ]
                    ],
                    [
                        'name' => 'Retail and sales',
                        'children' => [
                            ['name' => 'Sales Associate'],
                            ['name' => 'Sales Representative'],
                            ['name' => 'Sales Manager'],
                            ['name' => 'Retail Worker'],
                            ['name' => 'Store Manager'],
                            ['name' => 'Sales Representative'],
                            ['name' => 'Sales Manager'],
                            ['name' => 'Real Estate Broker'],
                            ['name' => 'Sales Associate'],
                            ['name' => 'Cashier'],
                            ['name' => 'Store Manager'],
                            ['name' => 'Account Executive'],
                            ['name' => 'Account Manager'],
                            ['name' => 'Area Sales Manager'],
                            ['name' => 'Direct Salesperson'],
                            ['name' => 'Director of Inside Sales'],
                            ['name' => 'Outside Sales Manager'],
                            ['name' => 'Sales Analyst'],
                            ['name' => 'Market Development Manager'],
                            ['name' => 'B2B Sales Specialist'],
                            ['name' => 'Sales Engineer'],
                            ['name' => 'Merchandising Associate'],
                        ]
                    ],
                    [
                        'name' => 'Construction',
                        'children' => [
                            ['name' => 'Construction Worker'],
                            ['name' => 'Taper'],
                            ['name' => 'Plumber'],
                            ['name' => 'Heavy Equipment Operator'],
                            ['name' => 'Vehicle or Equipment Cleaner'],
                            ['name' => 'Carpenter'],
                            ['name' => 'Electrician'],
                            ['name' => 'Painter'],
                            ['name' => 'Welder'],
                            ['name' => 'Handyman'],
                            ['name' => 'Boilermaker'],
                            ['name' => 'Crane Operator'],
                            ['name' => 'Building Inspector'],
                            ['name' => 'Pipefitter'],
                            ['name' => 'Sheet Metal Worker'],
                            ['name' => 'Iron Worker'],
                            ['name' => 'Mason'],
                            ['name' => 'Roofer'],
                            ['name' => 'Solar Photovoltaic Installer'],
                            ['name' => 'Well Driller'],
                        ]
                    ],
                    [
                        'name' => 'Writer',
                        'children' => [
                            ['name' => 'Journalist'],
                            ['name' => 'Copy Editor'],
                            ['name' => 'Editor/Proofreader'],
                            ['name' => 'Content Creator'],
                            ['name' => 'Speech Writer'],
                            ['name' => 'Communications Director'],
                            ['name' => 'Screenwriter'],
                            ['name' => 'Technical Writer'],
                            ['name' => 'Columnist'],
                            ['name' => 'Public Relations Specialist'],
                            ['name' => 'Proposal Writer'],
                            ['name' => 'Content Strategist'],
                            ['name' => 'Grant Writer'],
                            ['name' => 'Video Game Writer'],
                            ['name' => 'Translator'],
                            ['name' => 'Film Critic'],
                            ['name' => 'Copywriter'],
                            ['name' => 'Travel Writer'],
                            ['name' => 'Social Media Specialist'],
                            ['name' => 'Ghost Writer'],
                        ]
                    ],
                    [
                        'name' => 'Driving',
                        'children' => [
                            ['name' => 'Delivery Driver'],
                            ['name' => 'School Bus Driver'],
                            ['name' => 'Truck Driver'],
                            ['name' => 'Tow Truck Driver'],
                            ['name' => 'UPS Driver'],
                            ['name' => 'Mail Carrier'],
                            ['name' => 'Recyclables Collector'],
                            ['name' => 'Courier'],
                            ['name' => 'Bus Driver'],
                            ['name' => 'Cab Driver'],
                        ]
                    ],
                    [
                        'name' => 'Finance and Accounting',
                        'children' => [
                            ['name' => 'Credit Authorizer'],
                            ['name' => 'Benefits Manager'],
                            ['name' => 'Credit Counselor'],
                            ['name' => 'Accountant'],
                            ['name' => 'Bookkeeper'],
                            ['name' => 'Accounting Analyst'],
                            ['name' => 'Accounting Director'],
                            ['name' => 'Accounts Payable/Receivable Clerk'],
                            ['name' => 'Auditor'],
                            ['name' => 'Budget Analyst'],
                            ['name' => 'Controller'],
                            ['name' => 'Financial Analyst'],
                            ['name' => 'Finance Manager'],
                            ['name' => 'Economist'],
                            ['name' => 'Payroll Manager'],
                            ['name' => 'Payroll Clerk'],
                            ['name' => 'Financial Planner'],
                            ['name' => 'Financial Services Representative'],
                            ['name' => 'Finance Director'],
                            ['name' => 'Commercial Loan Officer'],
                        ]
                    ],
                    [
                        'name' => 'On the phone jobs',
                        'children' => [
                            ['name' => 'Call Center Representative'],
                            ['name' => 'Customer Service'],
                            ['name' => 'Telemarketer'],
                            ['name' => 'Telephone Operator'],
                            ['name' => 'Phone Survey Conductor'],
                            ['name' => 'Dispatcher for Trucks or Taxis'],
                            ['name' => 'Customer Support Representative'],
                            ['name' => 'Over the Phone Interpreter'],
                            ['name' => 'Phone Sales Specialist'],
                            ['name' => 'Mortgage Loan Processor'],
                        ]
                    ],
                    [
                        'name' => 'Work with Animal jobs',
                        'children' => [
                            ['name' => 'Animal Breeder'],
                            ['name' => 'Veterinary Assistant'],
                            ['name' => 'Farm Worker'],
                            ['name' => 'Animal Shelter Worker'],
                            ['name' => 'Dog Walker/ Pet Sitter'],
                            ['name' => 'Zoologist'],
                            ['name' => 'Animal Trainer'],
                            ['name' => 'Service Dog Trainer'],
                            ['name' => 'Animal Shelter Manager'],
                            ['name' => 'Animal Control Officer'],
                        ]
                    ],
                    [
                        'name' => 'Artistic',
                        'children' => [
                            ['name' => 'Graphic Designer'],
                            ['name' => 'Artist'],
                            ['name' => 'Interior Designer'],
                            ['name' => 'Video Editor'],
                            ['name' => 'Video or Film Producer'],
                            ['name' => 'Playwright'],
                            ['name' => 'Musician'],
                            ['name' => 'Novelist/Writer'],
                            ['name' => 'Computer Animator'],
                            ['name' => 'Photographer'],
                            ['name' => 'Camera Operator'],
                            ['name' => 'Sound Engineer'],
                            ['name' => 'Motion Picture Director'],
                            ['name' => 'Actor'],
                            ['name' => 'Music Producer'],
                            ['name' => 'Director of Photography'],
                        ]
                    ],
                ]
            ], // 3
            [
                'name' => 'Accommodation',
                'children' => [
                    ['name' => 'Hotels'],
                    ['name' => 'Guest House'],
                    ['name' => 'Apartment'],
                    ['name' => 'Home Stay'],
                    ['name' => 'Paying Guest'],
                    ['name' => 'Flats or Rooms'],
                ]
            ], // 4
            [
                'name' => 'Motor & Vehicles',
                'children' => [
                    ['name' => 'Bicycle'],
                    ['name' => 'Bus'],
                    ['name' => 'Car'],
                    ['name' => 'Motorbike'],
                    ['name' => 'Limousine'],
                    ['name' => 'Scooter'],
                    ['name' => 'Trucks'],
                ]
            ], // 5
            [
                'name' => 'Real Estate',
                'children' => [
                    ['name' => 'Commercial Properties'],
                    ['name' => 'Farms & Land'],
                    ['name' => 'House'],
                    ['name' => 'Rentals'],
                    ['name' => 'Others'],
                ]
            ], // 6
        ];

        foreach ($categories as $category) {
            $temp = collect($category);
            $root = $this->createCategory($temp->except('children')->all());

            if (array_key_exists('children', $category)) {
                foreach ($category['children'] as $child){
                    $temp = collect($child);
                    $temp['parent_id'] = $root->id;
                    $level1 = $this->createCategory($temp->except('children')->all());

                    if (array_key_exists('children', $child)) {
                        foreach ($child['children'] as $grandChild){
                            $temp = collect($grandChild);
                            $temp['parent_id'] = $level1->id;
                            $level2 = $this->createCategory($temp->except('children')->all());
                        }
                    }

                }
            }
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    private function createCategory($data){
        return Category::create($data);
    }
}
