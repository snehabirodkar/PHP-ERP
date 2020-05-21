<?php
class Supplier{
    private $table = "suppliers";
    private $address_table = "address";
    private $address_link = "address_supplier";
    private $columns = ['id', 'first_name','last_name','gst_no','phone_no','email_id','gender'];
    private $columns_address = ['id','block_no','street','city','pincode','country','town'];
    private $columns_address_link = ['id','address_id','customer_id'];
    protected $di;
    private $database;
    private $validator;
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    public function getValidator(){
        return $this->validator;
    }
    public function ValidateData($data)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data,[
            'first_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
                

            ],'last_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20

            ],'gst_no'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                'unique'=>$this->table

            ],'phone_no'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                'unique'=>$this->table
                

            ],'email_id'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                'unique'=>$this->table

            ],'company_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                

            ],
            'block_no'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ],
            'street'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>20
            ],
            'city'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ],
            'pincode'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ],
            'state'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ],
            'country'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ],
            'town'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ]
        ]);
        
    }

    public function ValidateEditData($data)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data,[
            'first_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
                

            ],'last_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20

            ],'gst_no'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                
            ],'phone_no'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                
                

            ],'email_id'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                

            ],'company_name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                

            ]
        ]);
        
    }


    

    public function addSupplier($data)
    {
        
        //VALIDATE DATA
        $this->ValidateData($data);

        //INSERT DATA IN DATABASE
        if(!$this->validator->fails())
        {
            try{
                $this->database->beginTransaction();
                $data_to_be_inserted['first_name'] = $data['first_name'];
                $data_to_be_inserted['last_name'] = $data['last_name'];
                $data_to_be_inserted['gst_no'] = $data['gst_no'];
                $data_to_be_inserted['phone_no'] = $data['phone_no'];
                $data_to_be_inserted['email_id'] =$data['email_id'];
                $data_to_be_inserted['company_name'] = $data['company_name'];

                $address_to_be_inserted['block_no'] = $data['block_no'];
                $address_to_be_inserted['street'] = $data['street'];
                $address_to_be_inserted['city'] = $data['city'];
                $address_to_be_inserted['pincode'] = $data['pincode'];
                $address_to_be_inserted['state'] = $data['state'];
                $address_to_be_inserted['country'] = $data['country'];
                $address_to_be_inserted['town'] = $data['town'];
        
                
                $supplier_id = $this->database->insert($this->table,$data_to_be_inserted);
                $address_id = $this->database->insert($this->address_table,$address_to_be_inserted);

                $mapping['address_id']= $address_id;
                $mapping['supplier_id']= $supplier_id;
                $map_address_id = $this->database->insert($this->address_link,$mapping);
                //Util::dd($data_to_be_inserted);
               
                $this->database->commit();
                return ADD_SUCCESS;
            }
            catch(Exception $e)
            {
                $this->database->rollBack();
                return ADD_ERROR;
            }
        }
        
        return VALIDATION_ERROR;
    }

    public function getJSONDataForDataTable($draw,$search_parameter,$order_by,$start,$length){
        $query = "SELECT * FROM {$this->table} WHERE deleted = 0";
        
        // Util::dd($query);

        $totalRowCountQuery = "SELECT COUNT(*) as total_count FROM {$this->table} WHERE deleted = 0";
        $filteredRowCountQuery = "SELECT COUNT(*) as total_count FROM {$this->table} WHERE deleted = 0";

        if($search_parameter != null)
        {
            $query .= " AND (first_name LIKE '%{$search_parameter}%' OR last_name LIKE '%{$search_parameter}%')";
            $filteredRowCountQuery .= " AND (first_name LIKE '%{$search_parameter}%' OR last_name LIKE '%{$search_parameter}%')";
        }

    //Util::dd($this->columns[$order_by[0]['column']]);

    if($order_by != null)
    {
        $query .= " ORDER BY {$this->columns[$order_by[0]['column']]} {$order_by[0]['dir']}";

        $filteredRowCountQuery .= " ORDER BY {$this->columns[$order_by[0]['column']]} {$order_by[0]['dir']}";


    }
    else{
        $query .= " ORDER BY {$this->columns[0]} ASC";
        $filteredRowCountQuery .= "ORDER BY {$this->columns[0]} ASC";
    }

    if($length!=-1)
    {
        $query .= " LIMIT {$start}, {$length}";
    }

    $totalRowCountResult = $this->database->raw($totalRowCountQuery);

    $numberOfTotalRows = is_array($totalRowCountResult) ? $totalRowCountResult[0]->total_count : 0;

    $filteredRowCountResult = $this->database->raw($filteredRowCountQuery);

    $numberOfFilteredRows = is_array($filteredRowCountResult) ? $filteredRowCountResult[0]->total_count : 0;

    $fetchedData = $this->database->raw($query);//select queries ke liye raw vaparte
    $baseassets=BASEASSETS;
    $data = [];
    $numRows = is_array($fetchedData) ? count($fetchedData) : 0;
    for($i=0;$i<$numRows;$i++){
        $subArray = [];
        $subArray[] = $start+$i+1;
        $subArray[] = $fetchedData[$i]->first_name." ".$fetchedData[$i]->last_name;
        $subArray[] = $fetchedData[$i]->gst_no;
        $subArray[] = $fetchedData[$i]->phone_no;
        $subArray[] = $fetchedData[$i]->email_id;
        $subArray[] = $fetchedData[$i]->company_name;
        $subArray[] = <<<BUTTONS
<form  action="{$baseassets}../helper/routing.php" method="POST" style="display:inline">
<input type="hidden" name="supplier_id" value="{$fetchedData[$i]->id}">
<button class='btn btn-outline-primary btn-sm edit' name="edit_data" data-id='{$fetchedData[$i]->id}'><i class="fas fa-pencil-alt"></i></a></button>
</form>
<button class='btn btn-outline-danger btn-sm delete' data-id='{$fetchedData[$i]->id}' data-toggle='modal' data-target='#deleteModal'><i class="fas fa-trash-alt"></i></button>   
BUTTONS;

        $data[] = $subArray;//multidimensional array mai baith jayega {subarray[],subarray[]....}
    }

    $output = array(
        'draw'=>$draw,
        'recordsTotal'=>$numberOfTotalRows,
        'recordsFiltered'=>$numberOfFilteredRows,
        'data'=>$data
    );
    echo json_encode($output);
    }

   public function getSupplierByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id} AND deleted = 0";
        $result = $this->database->raw($query,$fetchMode);
        return $result;
    }
    public function update($data,$id)
    {
        $data_to_be_updated['first_name'] =  $data['first_name'];
        $data_to_be_updated['last_name'] =  $data['last_name'];
        
        $old =  $this->getSupplierByID($id,PDO::FETCH_ASSOC);
      
        if($old[0]['gst_no']!=$data['gst_no']){
            
            $data_to_be_updated['gst_no'] =  $data['gst_no'];
            
        }

        if($old[0]['phone_no']!=$data['phone_no']){
            
            $data_to_be_updated['phone_no'] =  $data['phone_no'];
            
        }

        if($old[0]['email_id']!=$data['email_id']){
            
            $data_to_be_updated['email_id'] =  $data['email_id'];
            
        }

        $data_to_be_updated['company_name'] =  $data['company_name'];
    
        
        $this->ValidateEditData($data_to_be_updated);
        if(!$this->validator->fails())
        {
            try{
                $this->database->beginTransaction();
               
                $this->database->update($this->table,$data_to_be_updated,"id = {$id}");
                
                $this->database->commit();
                
                return UPDATE_SUCCESS;
            }catch(Exception $e){
                $this->database->rollBack();
                return UPDATE_ERROR;
            }
        }
        else{
            return VALIDATION_ERROR;
        }
        
    }

    public function delete($id)
    {
        try{
            $this->database->beginTransaction();
            $this->database->delete($this->table,"id={$id}");
            $this->database->commit();
            return DELETE_SUCCESS;
        }catch(Exception $e){
            $this->database->rollBack();
            return DELETE_ERROR;
        }
    }
}
?>