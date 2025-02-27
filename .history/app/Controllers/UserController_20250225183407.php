
namespace App\Controllers;

use App\Models\ProductModel;
use Rakit\Validation\Validator;  //validate

class ProductController extends Controller 
{
    private $productModel;
    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel();
    }
