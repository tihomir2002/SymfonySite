<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Controller extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('homepage.html.twig', [
            'vehicles' => $this->getVehicles(),
        ]);
    }

    #[Route('/vehicle/{vehicleId}', name: 'vehicle', methods: ['GET'])]
    public function vehicle(int $vehicleId): Response
    {
        $vehicle = $this->getVehicle($vehicleId);
        $userProfileIds = $this->select("UserProfileId", $this->fetchBids($vehicleId));

        return $this->render('vehiclePage.html.twig', [
            'vehicle' => $vehicle,
            'bids' => $this->fetchBids($vehicleId),
            'userProfiles' => $this->fetchUsers($userProfileIds),
            'mainImage' => $this->getMainImage($vehicle),
            'images' => $this->getImages($vehicle)
        ]);
    }

    #[Route('/about', name: 'about', methods: ['GET'])]
    public function about()
    {
        return $this->render('about.html.twig');
    }

    private function getVehicles(): array
    {
        return [
            ["Id" => 1, "Currency" => '$', "Title" => "Vehicle One", "Desc" => "Very nice vehicle this one", "HighestBid" => 2002, "Images" => ["/assets/vehicle.avif", "/assets/vehicle.avif", "/assets/vehicle.avif", "/assets/vehicle.avif", "/assets/vehicle.avif","/assets/vehicle.avif","/assets/vehicle.avif","/assets/vehicle.avif"]],
            ["Id" => 2, "Currency" => '$', "Title" => "Vehicle Two", "Desc" => "Very nice vehicle this one", "HighestBid" => 546346, "Images" => ["/assets/vehicle.avif"]],
            ["Id" => 3, "Currency" => '$', "Title" => "Vehicle Three", "Desc" => "Very nice vehicle this one", "HighestBid" => 5257, "Images" => ["/assets/vehicle.avif"]],
            ["Id" => 4, "Currency" => '$', "Title" => "Vehicle Four", "Desc" => "Very nice vehicle this one", "HighestBid" => 32532, "Images" => ["/assets/vehicle.avif"]],
            ["Id" => 5, "Currency" => '$', "Title" => "Vehicle Five", "Desc" => "Very nice vehicle this one", "HighestBid" => 25002, "Images" => ["/assets/vehicle.avif"]],
            ["Id" => 6, "Currency" => '$', "Title" => "Vehicle Six", "Desc" => "Very nice vehicle this one", "HighestBid" => 2131, "Images" => "/assets/vehicle.avif"],
            ["Id" => 7, "Currency" => '$', "Title" => "Vehicle Seven", "Desc" => "Very nice vehicle this one", "HighestBid" => 32553252, "Images" => ["/assets/vehicle.avif"]]
        ];
    }

    private function getVehicle(int $id): ?array
    {
        $vehicles = $this->getVehicles();
        foreach($vehicles as $vehicle)
        {
            if($vehicle['Id'] == $id)
            {
                return $vehicle;
            }
        }

        return null;
    }

    private function fetchAllBids(): array
    {
        return [
            ["Id" => 1, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 2, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 3, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 4, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 5, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 6, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 7, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 8, "Amount" => "1337", "AuctionId" => 1, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 9, "Amount" => "1337", "AuctionId" => 4, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 10, "Amount" => "1337", "AuctionId" => 4, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 11, "Amount" => "1337", "AuctionId" => 4, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 12, "Amount" => "1337", "AuctionId" => 5, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 13, "Amount" => "1337", "AuctionId" => 5, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 14, "Amount" => "1337", "AuctionId" => 5, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1],
            ["Id" => 15, "Amount" => "1337", "AuctionId" => 5, "CreatedAt" =>date('Y-m-d h:i:sa',  mktime(10, 55, 30, 21, 9, 2002)), "UserProfileId" => 1]
        ];
    }

    private function fetchBids(int $auctionId): array
    {
        $allBids = $this->fetchAllBids();
        $auctionBids = [];

        foreach ($allBids as $bid) {
            if ($bid["AuctionId"] == $auctionId) {
                $auctionBids[] = $bid;
            }
        }

        return $auctionBids;
    }

    private function fetchAllUsers(): array
    {
        return [
            ['Id' => 1, 'Username' => 'DynamicUsername', 'Picture' => "assets/speedometer.avif"]
        ];
    }

    private function fetchUsers(array $userProfileIds): array
    {
        $allUsers = $this->fetchAllUsers();
        $users = [];

        foreach ($allUsers as $user) {
            if (in_array($user["Id"], $userProfileIds)) {
                $users[] = $user;
            }
        }

        return $users;
    }

    private function fetchUser(int $userProfileId): ?array
    {
        $allUsers = $this->fetchAllUsers();

        foreach ($allUsers as $user) {
            if ($userProfileId == $user['Id']) {
                return $user;
            }
        }

        return null;
    }


    private function select(string $propertyName, array $collection) : array {
        $selected = [];

        foreach ($collection as $item) {
            if(!isset($item[$propertyName])) {
                continue;
            }

            $selected[] = $item[$propertyName];
        }

        return $selected;
    }

    private function getMainImage(array $vehicle) : string
    {
        if(!isset($vehicle["Images"])) {
            return '';
        }

        if(sizeof($vehicle["Images"]) == 0) {
            return '';
        }

        return $vehicle["Images"][0];
    }
    private function getImages(array $vehicle) : array
    {
        if(!isset($vehicle["Images"])) {
            return [];
        }

        if(sizeof($vehicle["Images"]) <= 1) {
            return [];
        }

        return array_slice($vehicle["Images"], 1);
    }
}