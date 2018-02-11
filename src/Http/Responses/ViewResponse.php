<?php

namespace SebastiaanLuca\Flow\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

abstract class ViewResponse implements Responsable
{
    /**
     * @var array
     */
    protected $viewData = [];

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) : Response
    {
        return view($this->getView(), $this->viewData);
    }

    /**
     * @return string
     */
    abstract public function getView() : string;

    /**
     * @param array|string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function addViewData($key, $value = null)
    {
        $data = $key;

        if (! is_array($key)) {
            $data = [$key => $value];
        }

        $this->viewData = array_merge($this->viewData, $data);

        return $this;
    }

    /**
     * @return array
     */
    public function getViewData() : array
    {
        return $this->viewData;
    }
}
