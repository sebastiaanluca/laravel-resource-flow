<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\View\View;

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
     * @return \Illuminate\View\View
     */
    public function toResponse($request) : View
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
    public function addViewData($key, $value = null) : self
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
