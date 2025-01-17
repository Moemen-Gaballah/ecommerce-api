<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomPaginationMobileResource extends JsonResource
{
    protected $collectionResource;
    public function __construct($resource, $collectionResource)
    {
        parent::__construct($resource);
        $this->collectionResource = $collectionResource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'list'       => $this->collectionResource,
            'pagination' => [
                'perPage' => (int)$this->perPage(),
                'pageCount' => (int)$this->count(),
                'totalCount' => (int)$this->total(),
                'currentPage' => (int)$this->currentPage(),
                'totalPages' => (int)$this->lastPage()
            ]
        ];
    }
}
