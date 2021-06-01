<?php

    namespace App\Http\Controllers;

    use App\Models\Books;
    use App\Models\Authors;

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
            $books = DB::connection('mysql')->select('Select * from tblbooks');
            $author = DB::connection('mysql')->select('Select * from tblauthors');

            return $this->successResponse($books, $author);
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
                'id' => 'required|numeric|min:1|not_in:0',
            ];

            $this->validate($request, $rules);

            $author = Authors::findOrFail($request->authorid);
            $book = Books::create($request->all());

            return $this->successResponse($book, Response::HTTP_CREATED);
        }

        /**
        * Obtains and show one book
        * @return Illuminate\Http\Response
        */
        
        public function show($id){
            
            $book = Books::findOrFail($id);
            return $this->successResponse($book);
        
        }

        /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
        public function update(Request $request, $id){
            $rules = [
                'bookname' => 'required|min:1|not_in:0',
                'yearpublish' => 'required|min:1|not_in:0',
                'id' => 'required|numeric|min:1|not_in:0',
            ];

            $this->validate($request, $rules);

            $book = Books::where('id', $id)->first();
            $author = Authors::findOrFail($request->authorid);

            if ($book){
            $book->fill($request->all());
            // if no changes happen
            if ($book->isClean()) {
                return $this->errorResponse('At least one value must change', 
                Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $book->save();
            return $this->successResponse($book);
            }
        }

        /**
         * Remove an existing book
         * @return Illuminate\Http\Response
         */

         public function delete($id){
             $book = Books::findOrFail($id);
             $book->delete();
             return $this->errorResponse('Book ID Does Not Exists', Response::HTTP_NOT_FOUND);
         }

}

?>