<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class AffiliateLinkController extends Controller
{
    /**
     * Display a listing of affiliate links.
     */
    public function index(Request $request): InertiaResponse
    {
        $query = AffiliateLink::with(['pizza.brand', 'affiliate']);

        // Filter by pizza if provided
        if ($request->has('pizza_id')) {
            $query->where('pizza_id', $request->pizza_id);
        }

        // Filter by affiliate (vendor) if provided
        if ($request->filled('affiliate_id')) {
            $query->where('affiliate_id', $request->affiliate_id);
        }

        $links = $query->orderBy('pizza_id')
            ->orderBy('display_order')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Admin/AffiliateLinks/Index', [
            'links' => $links,
            'filters' => $request->only(['pizza_id', 'affiliate_id']),
            'pizzas' => Pizza::select('id', 'name', 'brand_id')->with('brand:id,name')->orderBy('name')->get(),
            'affiliates' => Affiliate::orderBy('display_order')->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Show the form for creating a new affiliate link.
     * 
     * @api {get} /admin/affiliate-links/create Create Affiliate Link
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/AffiliateLinks/Create', [
            'pizzas' => Pizza::select('id', 'name', 'brand_id')
                ->with('brand:id,name')
                ->orderBy('name')
                ->get(),
            'affiliates' => Affiliate::where('is_active', true)->orderBy('display_order')->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created affiliate link in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'affiliate_id' => 'required|exists:affiliates,id',
            'url' => 'required|url|max:2000',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        AffiliateLink::create($validated);

        return Redirect::route('admin.affiliate-links.index')
            ->with('success', 'Affiliate link created successfully.');
    }

    /**
     * Show the form for editing the specified affiliate link.
     */
    public function edit(AffiliateLink $affiliateLink): InertiaResponse
    {
        $affiliateLink->load('affiliate');

        return Inertia::render('Admin/AffiliateLinks/Edit', [
            'affiliateLink' => $affiliateLink,
            'pizzas' => Pizza::select('id', 'name', 'brand_id')
                ->with('brand:id,name')
                ->orderBy('name')
                ->get(),
            'affiliates' => Affiliate::where('is_active', true)->orderBy('display_order')->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified affiliate link in storage.
     */
    public function update(Request $request, AffiliateLink $affiliateLink): RedirectResponse
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'affiliate_id' => 'required|exists:affiliates,id',
            'url' => 'required|url|max:2000',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        $affiliateLink->update($validated);

        return Redirect::route('admin.affiliate-links.index')
            ->with('success', 'Affiliate link updated successfully.');
    }

    /**
     * Remove the specified affiliate link from storage.
     */
    public function destroy(AffiliateLink $affiliateLink): RedirectResponse
    {
        $affiliateLink->delete();

        return Redirect::back()
            ->with('success', 'Affiliate link deleted successfully.');
    }

    /**
     * Bulk update display order of affiliate links.
     */
    public function updateOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'links' => 'required|array',
            'links.*.id' => 'required|exists:affiliate_links,id',
            'links.*.display_order' => 'required|integer|min:0',
        ]);

        foreach ($validated['links'] as $link) {
            AffiliateLink::where('id', $link['id'])
                ->update(['display_order' => $link['display_order']]);
        }

        return Redirect::back()
            ->with('success', 'Display order updated successfully.');
    }
}
