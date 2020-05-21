<?php
class Product
{
    private $table = "products";
    protected $id;
    private $database;
    private $validator;
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    public function getValidator()
    {
        return $this->validator;
    }
    public function validateData($data)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data, [
            'name' => [
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20
            ]
        ]);
    }

    // public function addProduct($data){
    //     $this->validateData($data);
    //     if(!$this->validator->fails()){
    //         try{
    //             $table_attr=['name'=>0,'specification'=>0,'hsn_code'=>0,'category_id'=>0,'eoq_level'=>0,'danger_level'=>0];
    //             $data_to_be_inserted = array_intersect_keys($this->table,$data_to_be_inserted);
    //             $data_to_be_inserted['quantity'] = 0;

    //             $this->database->beginTransaction();
    //             $product_id = $this->database->insert($this->table, $data_to_be_inserted);
    //             $data_for_product_supplier['product_id'] = $product_id;
    //         }catch(Exceptio $e){

    //         }
    //     }
    // }
    
    public function getJSONDataForDataTable($draw,$search_parameter,$order_by,$start,$length)
    {
        $columns = ['products.id','products.name','products.specification','products.quantity',' products_selling_rate.selling_rate','products_selling_rate.with_effect_from','category.name','products.eoq_level', 'products.danger_level'];
        $query = "SELECT products.id, products.name as product_name, products.specification, products.quantity, products.eoq_level, products.danger_level, category.name as category_name, GROUP_CONCAT(CONCAT(suppliers.first_name, \" \",suppliers.last_name) SEPARATOR ' | ') as supplier_name, products_selling_rate.selling_rate,products_selling_rate.with_effect_from FROM products_selling_rate INNER JOIN (SELECT product_id, MAX(with_effect_from) as wef FROM (SELECT product_id,with_effect_from FROM products_selling_rate WHERE with_effect_from<= CURRENT_TIMESTAMP) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef INNER join products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0";

        $groupBy = " GROUP BY products.id";

        $totalRowCountQuery = "SELECT DISTINCT(COUNT(*) OVER()) as total_count FROM products_selling_rate INNER JOIN (SELECT product_id, MAX(with_effect_from) as wef FROM (SELECT product_id,with_effect_from FROM products_selling_rate WHERE with_effect_from<= CURRENT_TIMESTAMP) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef INNER join products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0 GROUP BY products.id";


        $filteredRowCountQuery = "SELECT DISTINCT(COUNT(*) OVER()) as total_count FROM products_selling_rate INNER JOIN (SELECT product_id, MAX(with_effect_from) as wef FROM (SELECT product_id,with_effect_from FROM products_selling_rate WHERE with_effect_from<= CURRENT_TIMESTAMP) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef INNER join products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0";
        
        if($search_parameter != null)
        {
            $condition = " AND products.name LIKE '%{$search_parameter}%' OR products.specification LIKE '%{$search_parameter}%' OR category.name LIKE '%{$search_parameter}%' OR suppliers.first_name LIKE '%{$search_parameter}%' OR suppliers.last_name LIKE '%{$search_parameter}%'";
            $query .= $condition;
            $filteredRowCountQuery .= $condition;
        }
        
        $query .= $groupBy;
        $filteredRowCountQuery .= $groupBy;
        // Util::dd($columns[$order_by[0]['column']]);
        if($order_by != null)
        {
            $query .= " ORDER BY {$columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
            $filteredRowCountQuery .= " ORDER BY {$columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
        }
        else
        {
            $query .= " ORDER BY {$columns[0]} ASC";
            $filteredRowCountQuery .= " ORDER BY {$columns[0]} ASC";
        }
        if($length != -1)
        {
            $query .= " LIMIT {$start}, {$length}";
        }

        $totalRowCountResult = $this->database->raw($totalRowCountQuery);
        $numberOfTotalRows = is_array($totalRowCountResult) ? $totalRowCountResult[0]->total_count : 0;

        $filteredRowCountResult =  $this->database->raw($filteredRowCountQuery);
        $numberOfFilteredRows = is_array($filteredRowCountResult) ? $filteredRowCountResult[0]->total_count : 0;

        $fetchedData = $this->database->raw($query);
        $data = [];
        $basePages = BASEPAGES;
        $numRows = is_array($fetchedData) ? count($fetchedData) : 0;
        for($i=0; $i<$numRows; $i++)
        {
            $subArray = [];
            $subArray[] = $start+$i+1; 
            $subArray[] = $fetchedData[$i]->product_name;
            $subArray[] = $fetchedData[$i]->specification;
            $subArray[] = $fetchedData[$i]->quantity;
            $subArray[] = $fetchedData[$i]->selling_rate;
            $subArray[] = $fetchedData[$i]->with_effect_from;
            $subArray[] = $fetchedData[$i]->category_name;
            $subArray[] = $fetchedData[$i]->eoq_level;
            $subArray[] = $fetchedData[$i]->danger_level;
            $subArray[] = $fetchedData[$i]->supplier_name;
            //here doc
            $subArray[] = <<<BUTTONS
            <a href="{$basePages}edit-product.php?id={$fetchedData[$i]->id}" class='btn btn-outline-primary btn-sm edit' data-id='{$fetchedData[$i]->id}' data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i></a>
            <button class='btn btn-outline-danger btn-sm delete' data-id='{$fetchedData[$i]->id}' data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-alt"></i></button>
BUTTONS;

            $data[] = $subArray;
        }

        $output = array(
            'draw'=>$draw,
            'recordsTotal'=>$numberOfTotalRows,
            'recordsFiltered'=>$numberOfFilteredRows,
            'data'=>$data
        );
        echo json_encode($output);
    }
    public function getCustomerByID($id,$fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id} AND deleted = 0";
        $result = $this->database->raw($query,$fetchMode);
        return $result;
    }
    public function update($data,$id)
    {
        $data_to_be_updated = ['first_name'=>$data['first_name'],
        'last_name'=>$data['last_name'],
        'gst_no'=>$data['gst_no'],
        'phone_no'=>$data['phone_no'],
        'email_id'=>$data['email_id'],
        'gender'=>$data['gender']];
        $this->validateData($data_to_be_updated);
        if(!$this->validator->fails())
        {
            try{
                $this->database->beginTransaction();
                $result = $this->database->update($this->table,$data_to_be_updated,"id = {$id}");
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
            $this->database->delete($this->table,"id = {$id}");
            $this->database->commit();
            return DELETE_SUCCESS;
        }catch(Exception $e){
            $this->database->rollBack();
            return DELETE_ERROR;
        }
    }

}