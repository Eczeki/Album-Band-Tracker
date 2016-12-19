<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests\Band\AlbumFormRequest;
use App\Models\Band\Album;
use App\Models\Band\Band;
use Illuminate\Support\Facades\Input;
use App\Html\Grid;

class AlbumController extends Controller 
{
    use FormBuilderTrait;
    
    /**
     * Renders the Albums index page
     * 
     * @return Response
     */
    public function albumIndex() 
    {
        $bandId = (int)Input::get('band_id');
        return view('band.albums', [
            'grid' => $this->buildAlbumsGrid($bandId),
            'bands' => Band::all(),
            'selected_band' => $bandId
        ]);
    }
    
    /**
     * Renders the Album create page
     * 
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function createAlbum(FormBuilder $formBuilder) {
        $form = $formBuilder->create('App\Forms\Band\AlbumForm', [
            'method' => 'POST',
            'url' => route('album.store')
        ]);
        
        return view('band.create-album', compact('form'));
    }
    
    /**
     * Renders the Album edit page
     * 
     * @param FormBuilder $formBuilder
     * @param integer $id
     * @return Response
     */
    public function editAlbum(FormBuilder $formBuilder, $id) {        
        $form = $formBuilder->create('App\Forms\Band\AlbumForm', [
            'method' => 'POST',
            'url' => route('album.update', ['id' => $id]),
            'data' => Album::find($id)->toArray()
        ]);
        
        return view('band.edit-album', compact('form'));
    }
    
    /**
     * Saves the Album into the DB
     * 
     * @param BandFormRequest $request
     * @return void
     */
    public function storeAlbum(AlbumFormRequest $request) 
    {
        $message = 'Album Saved!';
        $redirectToRoute = 'album.home';        
        try {
            Album::create($request->all());
        } catch (\Exception $ex) {
            $redirectToRoute = 'album.create';
            $message = 'There was an error saving the Album. Please try again.';
        }
               
        return \Redirect::route($redirectToRoute)
                ->with('message', $message);
    }
    
    /**
     * Updates an existing Album in the DB
     * 
     * @param BandFormRequest $request
     * @param integer $id
     * @return void
     */
    public function updateAlbum(AlbumFormRequest $request, $id)
    {
        $message = 'Album Updated!';
        $redirectToRoute = 'album.home';                    
        $params = [];
        
        try {
            $album = Album::find($id);
            $album->update($request->all());
        } catch (\Exception $ex) {
            $redirectToRoute = 'album.edit';
            $params = ['id' => $id];
            $message = 'There was an error updating the Album. Please try again.';
        }
        
        return \Redirect::route($redirectToRoute, $params)
                ->with('message', $message);
    }
    
    /**
     * Deletes an existing Album from the DB
     * 
     * @param integer $id
     * @return void
     */
    public function deleteAlbum($id) {
        $message = 'Album successfully deleted!';
        $album = Album::find($id);        
        
        if(!$album->delete()) {
            $message = 'There was a problem deleting your Album. Please try again';
        }
        
        return \Redirect::route('album.home')
                ->with('message', $message);
    }
    
    /**
     * Configures columns and feeds data into the data grid to be displayed
     * in the albums index view
     * 
     * @return DataGrid
     */
    private function buildAlbumsGrid($bandId) 
    {        
        /**
         * If $bandId is not null then display only those albums that belong
         * to the given band
         */
        $grid = \DataGrid::source((empty($bandId)) ? new Album() : Album::where('band_id', $bandId));
        
        /**
         * Grid Columns
         */
        $grid->add('band_id', 'Band Name', true)->cell(function($value, $row) {    
            /**
             * Output the band name of the band associated with this album
             */
            return Grid::cellFormatter($value, $row->band);
        });
        
        $grid->add('name', 'Album Name', true);
        
        $grid->add('recorded_date', 'Recorded Date', true)->cell(function($value, $row) {
            /**
             * Just convert the default MySQL date format to something more familiar
             * to a US date format
             */
            return Grid::cellFormatter($value, date('m/d/Y', strtotime($value)));
        });
        
        $grid->add('release_date', 'Release Date', true)->cell(function($value, $row) {
            /**
             * Same as above just converting to a US format
             */
            return Grid::cellFormatter($value, date('m/d/Y', strtotime($value)));
        });
        
        $grid->add('number_of_tracks', 'Tracks', true)->cell(function($value, $row) {
            return Grid::cellFormatter($value, $value);
        });
        
        $grid->add('label', 'Label', true)->cell(function($value, $row) {
            return Grid::cellFormatter($value, $value);
        });
        
        $grid->add('producer', 'Producer', true)->cell(function($value, $row) {
            return Grid::cellFormatter($value, $value);
        });
        
        $grid->add('genre', 'Genre', true)->cell(function($value, $row) {
            return Grid::cellFormatter($value, $value);
        });
        
        $grid->add('edit', 'Actions')->cell(function($value, $row) {             
            return Grid::actionsCell("album/edit/{$row->id}", "album/delete/{$row->id}");
        });
        /**
         * End Grid Columns
         */
        
        /**
         * Create Album Button
         * Label: Add New Album
         * Linked URL: album/create
         */
        $grid->link('album/create', "Add New Album", "TR");
        
        $grid->orderBy('name', 'asc'); 
        $grid->paginate(15); 
        
        return $grid;
    }
}
