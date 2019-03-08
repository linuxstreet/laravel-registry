<?php

namespace Linuxstreet\Registry;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

/**
 * Class RegistryController.
 */
class RegistryController extends Controller
{
    /**
     * Placeholder for registry types.
     * @var array
     */
    private $registryTypes;

    /**
     * RegistryController constructor.
     */
    public function __construct()
    {
        $types = Registry::$types;
        $this->registryTypes = array_combine($types, $types);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registry::index')->with(['registry' => Registry::orderBy('key')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registry::create')->with(['registry' => null, 'types' => $this->registryTypes]);
    }

    /**
     * Show resource.
     *
     * @param Registry $registry
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Registry $registry)
    {
        return view('registry::show', compact('registry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateRegistry $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValidateRegistry $request)
    {
        try {
            Registry::create($request->only([
                'key',
                'value',
                'type',
                'comment'
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('registry::all.error_store'));
        }

        return redirect()->route('registry.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Registry $registry
     * @return $this
     */
    public function edit(Registry $registry)
    {
        return view('registry::edit')->with(['registry' => $registry, 'types' => $this->registryTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidateRegistry $request
     * @param Registry $registry
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(ValidateRegistry $request, Registry $registry)
    {
        $only = [
            'key',
            'value',
            'type',
            'comment'
        ];

        try {
            $registry->update($request->only($only));

            Artisan::call('config:clear');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('registry::all.error_update'));
        }

        return redirect()->route('registry.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Registry $registry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Registry $registry)
    {
        Registry::destroy($registry->id);

        return redirect()->back();
    }
}
