<?php 

namespace App\Http\Controllers\Classes;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Grade;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $classrooms = Classroom::all();
    $grades = Grade::all();
    return view('pages.Classes.classes', compact('classrooms', 'grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ClassroomRequest $request)
  {
    // dd($request->all());
    // $List_Class= $request->List_Classes;
    // $this->validate(
    //   $request->List_Classes   , 
    // [
    //   'name_ar' => 'required',
    //   'name_en' => 'required',
    // ],
    // [
    //   'name_ar.required' => __('classes_trans.class_name_ar_required'),
    //   'name_en.required' => __('classes_trans.class_name_en_required'),
    // ]);


    // if(Classroom::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists())
    //  {
    //    return redirect()->back()->withErrors(__('messages.repeated'));
    //  }
    try{
    //   $this->validate($request, 
    // [
    //   'name_ar' => 'required',
    //   'name_en' => 'required',
    // ],
    // [
    //   'name_ar.required' => __('classes_trans.class_name_ar_required'),
    //   'name_en.required' => __('classes_trans.class_name_en_required'),
    // ]);

      $List_Classes = $request->List_Classes;
       foreach ($List_Classes as $List_Class) {

        $classroom = new Classroom();
        // $translations = [
        //   'en' => $request->name_en,
        //   'ar' => $request->name_ar,
        //  ];
        // $classroom->setTranslations('name', $translations);
    
        $classroom->name = ['en' => $List_Class['name_en'], 'ar' => $List_Class['name_ar']];
        $classroom->notes = $List_Class['notes'];
        $classroom->grade_id = $List_Class['grade_id'];
        $classroom->save();

         }
        toastr()->success(__('messages.success'));
        return redirect()->route('classrooms.index');

      }
        catch(\Excption $e){
        return redirect()->back()->withError(['error' => $e->getMessage()]);

      }

        // $classroom = new Classroom();
        // $translations = [
        //   'en' => $request->name_en,
        //   'ar' => $request->name_ar,
        //  ];
        // $classroom->setTranslations('name', $translations);
    
    //     // $classroom->name = ['en' => $request->name_en , 'ar' => $request->name_ar];//translation
    //     $classroom->notes = $request->notes;
    //     $classroom->save();
    //     toastr()->success(__('messages.success'));
    //     return redirect()->route('grades.index');
    //   }
    //   catch(\Excption $e){
    //     return redirect()->back()->withError(['error' => $e->getMessage()]);

    //   }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    try{
    $Classrooms = Classroom::findOrFail($request->id);

    $Classrooms->update([

        $Classrooms->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
        $Classrooms->notes = $request->notes,
        $Classrooms->grade_id = $request->grade_id,
    ]);
    toastr()->success(trans('messages.update'));
    return redirect()->route('classrooms.index');
  }
   catch(\Excption $e){
     return redirect()->back()->withError(['error' => $e->getMessage()]);
   }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    
    $Classrooms = Classroom::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.delete'));
    return redirect()->route('classrooms.index');
  }
  public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }
    public function Filter_Classes(Request $request)
    {
        $grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
        return view('pages.Classes.classes',compact('grades'))->withDetails($Search);

    }

}

?>