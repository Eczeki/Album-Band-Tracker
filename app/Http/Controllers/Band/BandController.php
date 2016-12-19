<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests\Band\BandFormRequest;
use App\Models\Band\Band;
use App\Models\Band\Album;
use App\Html\Grid;

class BandController extends Controller 
{
    use FormBuilderTrait;
    
    /**
     * Shows all bands available in the DB
     *
     * @return Response
     */
    public function bandsIndex() {
        return view('band.bands', [
            'grid' => $this->buildBandsGrid()
        ]);
    }
    
    /**
     * Renders the Band create page
     * 
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function createBand(FormBuilder $formBuilder) {
        $form = $formBuilder->create('App\Forms\Band\BandForm', [
            'method' => 'POST',
            'url' => route('band.store')
        ]);
        
        return view('band.create-band', compact('form'));
    }
    
    /**
     * Renders the Band edit page
     * 
     * @param FormBuilder $formBuilder
     * @param integer $id
     * @return Response
     */
    public function editBand(FormBuilder $formBuilder, $id) {        
        $form = $formBuilder->create('App\Forms\Band\BandForm', [
            'method' => 'POST',
            'url' => route('band.update', ['id' => $id]),
            'data' => Band::find($id)->toArray()
        ]);
        
        return view('band.edit-band', [
            'form' => $form,
            'albumSet' => $this->getAlbumSet($id)
        ]);
    }
    
    /**
     * Saves the Band into the DB
     * 
     * @param BandFormRequest $request
     * @return void
     */
    public function storeBand(BandFormRequest $request) 
    {
        $message = 'Band Saved!';
        $redirectToRoute = 'home';        
        try {
            Band::create($request->all());
        } catch (\Exception $ex) {
            $redirectToRoute = 'band.create';
            $message = 'There was an error saving the Band. Please try again.';
        }
               
        return \Redirect::route($redirectToRoute)
                ->with('message', $message);
    }
    
    /**
     * Updates an existing Band in the DB
     * 
     * @param BandFormRequest $request
     * @param integer $id
     * @return void
     */
    public function updateBand(BandFormRequest $request, $id)
    {
        $message = 'Band Updated!';
        $redirectToRoute = 'home';
        $inputs = $request->all();
        $params = [];
        
        /**
         * FormBuilder actually removes still_active from the request
         * when the checkbox is left unchecked so we need to
         * set it here as we have still_active = 0 as default in the DB
         */
        if(!isset($inputs['still_active'])) {
            $inputs['still_active'] = false;
        }             
        
        try {
            $band = Band::find($id);
            $band->update($inputs);
        } catch (\Exception $ex) {
            $redirectToRoute = 'band.edit';
            $params = ['id' => $id];
            $message = 'There was an error updating the Band. Please try again.';
        }
        
        return \Redirect::route($redirectToRoute, $params)
                ->with('message', $message);
    }
    
    /**
     * Deletes an existing Band from the DB
     * 
     * @param integer $id
     * @return void
     */
    public function deleteBand($id) {
        $message = 'Band successfully deleted!';
        $band = Band::find($id);        
        
        if(!$band->delete()) {
            $message = 'There was a problem deleting your Band. Please try again';
        }
        
        return \Redirect::route('home')
                ->with('message', $message);
    }
    
    /**
     * Configures columns and feeds data into the data grid to be displayed
     * in the bands homepage view
     * 
     * @return DataGrid
     */
    private function buildBandsGrid() {

        $grid = \DataGrid::source(new Band());

        /**
         * Grid columns
         */
        $grid->add('name', 'Band Name', true);      
        
        $grid->add('start_date', 'Creation Date', true)->cell(function($value, $row) {
            /**
             * Just convert the default MySQL date format to something more familiar
             * to a US date format
             */
            return Grid::cellFormatter($value, date('m/d/Y', strtotime($value)));
        });
        
        $grid->add('website', 'Website', true)->cell(function($value, $row) {
            /**
             * This cell will output a link for a Grid that when clicked opens a new window
             */
            return Grid::cellFormatter($value, Grid::makeLink($value, $value, true));
        });
        
        $grid->add('still_active', 'Still Active', true)->cell(function($value, $row) {
            /**
             * This cell will output either a check or a cross depending on $value
             */
            return Grid::cellFormatter($value, Grid::booleanIcon((int)$value));            
        });
        
        $grid->add('edit', 'Actions')->cell(function($value, $row) {             
            return Grid::actionsCell("band/edit/{$row->id}", "band/delete/{$row->id}");
        });
        /**
         * End Grid Columns
         */
        
        /**
         * Create Band Button
         * Label: Add New Band
         * Linked URL: band/create
         */
        $grid->link('band/create', "Add New Band", "TR");
        
        $grid->orderBy('name', 'asc'); 
        $grid->paginate(15); 
        
        return $grid;
    }
    
    private function getAlbumSet($bandId)
    {
        $set = \DataSet::source(Album::where('band_id', $bandId));
        $set->paginate(9);
        $set->build();
        return $set;
    }
}
