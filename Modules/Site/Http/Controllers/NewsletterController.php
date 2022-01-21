<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Newsletter;

class NewsletterController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribePending($request->email);
            toast('You have subscribed to Garjoo Nepal newsletter.', 'success');
            return Redirect::back();
        } else {
            toast('You have already subscribed to Garjoo Nepal newsletter.', 'warning');
            return Redirect::back();
        }

    }
}
