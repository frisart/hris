<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerkiraanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
      'account'     => $this->account,
      'descript'    => $this->descript,
      'group_ac'    => $this->group_ac,
      'level_ac'    => $ $this->level_ac,
      'type_ac'     => $this->type_ac,
      'in_active'   => $this->in_active,
      'ho_account'  => $this->ho_account,
      'crnt_year_act'  => $this->crnt_year_act,
      'last_year_act'  => $this->last_year_act,
      'last_month_act'  => $this->last_month_act,
      'crnt_year_ytd_act'  => $this->crnt_year_ytd_act,
      'last_year_ytd_act'  => $this->last_year_ytd_act,
      'last_month_ytd_act'  => $this->last_month_ytd_act,
      'crnt_year_bdg'  => $this->crnt_year_bdg,
      'last_year_bdg'  => $this->last_year_bdg,
      'last_month_bdg'  => $this->last_month_bdg,
      'crnt_year_ytd_bdg'  => $this->crnt_year_ytd_bdg,
      'last_year_ytd_bdg'  => $this->last_year_ytd_bdg,
      'last_month_ytd_bdg'  => $this->last_month_ytd_bdg,
      'actual_prd01'  => $this->actual_prd01,
      'actual_prd02'  => $this->actual_prd02,
      'actual_prd03'  => $this->actual_prd03,
      'actual_prd04'  => $this->actual_prd04,
      'actual_prd05'  => $this->actual_prd05,
      'actual_prd06'  => $this->actual_prd06,
      'actual_prd07'  => $this->actual_prd07,
      'actual_prd08'  => $this->actual_prd08,
      'actual_prd09'  => $this->actual_prd09,
      'actual_prd10'  => $this->actual_prd10,
      'actual_prd11'  => $this->actual_prd11,
      'actual_prd12'  => $this->actual_prd12,
      'budget_prd01'  => $this->budget_prd01,
      'budget_prd02'  => $this->budget_prd02,
      'budget_prd03'  => $this->budget_prd03,
      'budget_prd04'  => $this->budget_prd04,
      'budget_prd05'  => $this->budget_prd05,
      'budget_prd06'  => $this->budget_prd06,
      'budget_prd07'  => $this->budget_prd07,
      'budget_prd08'  => $this->budget_prd08,
      'budget_prd09'  => $this->budget_prd09,
      'budget_prd10'  => $this->budget_prd10,
      'budget_prd11'  => $this->budget_prd11,
      'budget_prd12'  => $this->budget_prd12
        ];
    }
}
