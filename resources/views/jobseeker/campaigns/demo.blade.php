<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/details">

<input required type="file" class="form-control" name="images[]" placeholder="address" multiple>

<!-- 
public function store(request $request) {

        
        $input=$request->all();
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        /*Insert your data*/

        Detail::insert( [
            'images'=>  implode("|",$images),
            'description' =>$input['description'],
            //you can put other insertion here
        ]);

        return redirect('redirecting page');
} 
-->