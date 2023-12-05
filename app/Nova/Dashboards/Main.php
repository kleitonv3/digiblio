<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewBooks;
use App\Nova\Metrics\NewCopies;
use App\Nova\Metrics\NewLoans;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new NewBooks(),
            new NewCopies(),
            new NewLoans(),
        ];
    }
}
