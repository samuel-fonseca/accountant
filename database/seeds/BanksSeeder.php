<?php

use App\Bank;
use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
      $banks = $this->bankList();

      foreach( $banks as $bank )
      {
        $bank['slug'] = strtolower(
          str_replace(
            ' ',
            '-',
            $bank['name']
          )
        );

        Bank::create($bank);
      }
  }

  /**
   * List from Forbes (America's Best Banks 2020 List)
   * @link https://www.forbes.com/americas-best-banks/#73318533606e
   * 
   * @return array
   */
  protected function bankList()
  {
    return [
      [
        "name" => "CVB Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "SVB Financial Group",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Pacific Premier Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Home BancShares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Merchants",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Western Alliance Bancorp.",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "WesBanco",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Prosperity Bancshares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Glacier Bancorp Inc.",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Community Bank System",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "East West Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Columbia Banking System",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Bank OZK",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Independent Bank (MA)",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Renasant Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Cathay General Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Central Bancompany",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Hawaiian Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Independent Bank Group",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Capital One Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "United Community Banks",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Washington Federal",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "CenterState Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Commerce Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "PacWest Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Bank of Hawaii",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Pinnacle Financial Partners",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Banner",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Signature Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Axos Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Financial Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Comerica",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "International Bancshares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Hilltop Holdings",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Northern Trust",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Interstate Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First National Of Nebraska",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First BanCorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Heartland Financial USA",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "State Street",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Umpqua Holdings",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "JPMorgan Chase",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "M&T Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "TowneBank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Truist Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "South State",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "WSFS Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Webster Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Sterling Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Popular",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Bank of New York Mellon",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Zions Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Investors Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Atlantic Union Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "United Bankshares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Simmons Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Old National Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Republic Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "BancorpSouth",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Fifth Third Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "New York Community Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "US Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Synovus Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "IBERIABANK",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "F.N.B.",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Citizens Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Mechanics Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Provident Financial Svcs",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Midwest Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Hope Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Bank of America",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Northwest Bancshares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "BOK Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Texas Capital Bancshares",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Cadence Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Citigroup",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Huntington Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "People's United Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Ameris Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Great Western Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Valley Natl Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "UMB Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Trustmark",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Wintrust Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Flagstar Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "PNC Financial Services",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Associated Banc-Corp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Wells Fargo",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "TFS Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Regions Financial",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Hancock Whitney",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Berkshire Hills Bancorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Citizens Financial Group",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Fulton Bank",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Bankunited",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "KeyCorp",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "CIT Group",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "First Horizon National",
        "slug" => "",
        "url" => null,
      ],
      [
        "name" => "Customers Bancorp",
        "slug" => "",
        "url" => null,
      ],
    ];
  }
}
