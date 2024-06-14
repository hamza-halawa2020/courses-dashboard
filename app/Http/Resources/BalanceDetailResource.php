<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BalanceDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $response = [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'amount' => $this->amount,
        ];
        if ($this->adminAddedBalances->isNotEmpty()) {
            $response['adminAddedBalances'] = AdminAddedBalanceResource::collection($this->adminAddedBalances);
        }
        if ($this->qrAddedBalances->isNotEmpty()) {
            $response['qrAddedBalances'] = QrAddedBalanceResource::collection($this->qrAddedBalances);
        }
        if ($this->buyCourseBalance->isNotEmpty()) {
            $response['buyCourseBalance'] = BuyCourseBalanceResource::collection($this->buyCourseBalance);
        }

        return $response;
    }
}
