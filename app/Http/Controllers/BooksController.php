<?php

    namespace App\Http\Controllers;

    use App\Models\Books;

    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;
    use Illuminate\Http\Request;
    use DB;

    Class BooksController extends Controller {

        use ApiResponser;

        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }
        
        public function getBooks(){
            $books = Books::all();

            return $this->successResponse($books);
        }

        /**
         * Return the list of books
         * @return Illuminate\Http\Response
         */

        public function index(){
            $books = Books::all();
            return $this->successResponse($books);
        }


        public function add(Request $request){
            $rules = [
                'bookname' => 'required|min:1|not_in:0',
                'yearpublish' => 'required|min:1|not_in:0', 
                'jobid' => 'required|numeric|min:1|not_in:0',
            ];

            $this->validate($request, $rules);
            $books = Books::create($request->all());
            return $this->successResponse($books, Response::HTTP_CREATED);
        }

        /**
        * Obtains and show one book
        * @return Illuminate\Http\Response
        */
        
        public function show($id){
            
            $books = Books::findOrFail($id);
            return $this->successResponse($books);
        
        }

        /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
        public function update(Request $request, $id){
            $rules = [
                'bookname' => 'required|min:1|not_in:0',
                'yearpublish' => 'required|min:1|not_in:0',
                'jobid' => 'required|numeric|min:1|not_in:0',
            ];

            $this->validate($request, $rules);
            $books = Books::findOrFail($id);

            $books->fill($request->all());
            // if no changes happen
            if ($books->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $books->save();
            return $this->successResponse($books);
        }

        /**
         * Remove an existing book
         * @return Illuminate\Http\Response
         */

         public function delete($id){
             $books = Books::findOrFail($id);
             $books->delete();
             return $this->errorResponse('Book ID Does Not Exists', Response::HTTP_NOT_FOUND);
         }

}

?>