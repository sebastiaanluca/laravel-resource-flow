<?php

namespace SebastiaanLuca\Flow\Http;

use Illuminate\Contracts\View\View;

trait ShowsViews
{
    /**
     * @var array
     */
    protected $viewData = [];

    /**
     * @param string $path
     * @param array $data
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function view(string $path, array $data = []) : View
    {
        return view($path, $this->viewData, $data);
    }

    /**
     * @param array|string $key
     * @param mixed $value
     *
     * @return $this
     */
    protected function addViewData($key, $value = null)
    {
        $data = $key;

        if (! is_array($key)) {
            $data = [$key => $value];
        }

        $this->viewData = array_merge($this->viewData, $data);

        return $this;
    }
}
