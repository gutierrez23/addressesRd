<?php

namespace FgutierrezPHP\AddresesRd\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class MunicipalityFilter extends Filters
{
  /** 
   * Registered filters to operate break.
   *
   * @var array
   */
  protected $filters = ['query', 'include', 'sort', 'limit', 'provinceId'];

  /**
   * Filters CompanyLocation.
   *
   * @param string $value
   * @return Builder
   */
  protected function query(string $value): Builder
  {
    return $this->builder->where(function($query) use ($value) {
      $query->where('name', 'like', "%{$value}%");
    });
  }

  /**
   * @param string $value
   * @return Builder
   */
  protected function include(string $value): Builder
  {
    return $this->builder->with(explode(',', $value));
  }


  /**
   * Sort CompanyLocation first.
   * @param string $value
   *
   * @return Builder
   */
  protected function sort(string $value): Builder
  {
    if (!in_array($value, ['asc', 'desc', 'latest'])) {
      return $this->builder;
    }

    $this->builder->getQuery()->orders = null;

    if ($value === 'latest') {
      return $this->builder->orderByDesc('id');
    }

    return $this->builder->orderBy('created_at', $value);
  }

  /**
   * limit CompanyLocation result set.
   * @param string $value
   *
   * @return Builder
   */
  protected function limit(string $value): Builder
  {
    return $this->builder->take($value);
  }

  protected function provinceId($value){
    if($value != 'null'){
      return $this->builder->where('province_id', $value);
    }
  }
}
