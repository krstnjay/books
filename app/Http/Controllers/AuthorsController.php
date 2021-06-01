<?php

    namespace App\Http\Controllers;

    use App\Models\Authors;
    use Illuminate\Http\Response; 
    use App\Traits\ApiResponser;
    use Illuminate\Http\Request;
    use DB;

    Class AuthorsController extends Controller {    
        
        use ApiResponser;

        private $request;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }
   
        /**
        * Return the list of authors
        * @return Illuminate\Http\Response
        */

        public function index()
        {
            $author = Authors::all();
            return $this->successResponse($author);
        }

        /**
        * Obtains and show one authors
        * @return Illuminate\Http\Response
        */

        public function show($id)
        {
            $author = Authors::findOrFail($id);
            return $this->successResponse($author);
        }
   }