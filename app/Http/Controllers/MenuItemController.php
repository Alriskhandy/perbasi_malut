<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Posts;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuItemController extends Controller
{
    public function create()
    {
        // Mengambil semua item menu dan halaman untuk opsi Parent ID dan Page ID
        $menuItems = MenuItem::with(['children'])->get();  // Untuk parent ID
        $pages = Page::all();          // Untuk page ID
        
        return view('backend.menus.create', [
            'pages'=>$pages,
            'menuItems'=>$menuItems,
            'posts'=>Posts::all(),
            'categories'=>Categories::all(),
        ]);
    }

    /**
     * Store a newly created menu item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request->category_id);
        try {
            // Validasi data input
                $data =  $request->validate([
                    'label' => 'required|string|max:255',
                    'url' => 'nullable|string|max:255',
                    'parent_id' => 'nullable|integer',
                    'page_id' => 'nullable|integer',
                    'post_id' => 'nullable|integer',
                    'category_id' => 'nullable|integer|exists:categories,id',
                ]);

                
                $data['menu_id'] = 1;
                $data['order'] = MenuItem::where('menu_id', $request->menu_id)->max('order') + 1;

                // Simpan data menu item ke database dengan nilai 'order' otomatis
                MenuItem::create($data);

                return redirect()->route('menus.create')->with('success', 'Menu item created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('menus.create')->with('error',  $th->getMessage());
                    //throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:menu_items,id',
            'page_id' => 'nullable|integer|exists:pages,id',
        ]);
        
        // Find the menu item by ID
        $menuItem = MenuItem::findOrFail($id);
        
        // dd($menuItem);
    
        // Update the menu item with new data
        $menuItem->update($data);
        Alert::success('Berhasil', 'Menu Berhasil Diedit');
        return redirect()->route('menus.create')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Display a listing of the menu items.
     *
     * @return \Illuminate\View\View
     */


    public function updateOrder(Request $request)
    {
        // Retrieve the menu structure from the request
        $menuItems = $request->input('menu_structure');

        // Define a recursive function to update parent_id and order for each item
        function updateMenuItems($items, $parentId = null)
        {
            foreach ($items as $index => $item) {
                MenuItem::where('id', $item['id'])->update([
                    'parent_id' => $parentId,
                    'order' => $index + 1,
                ]);

                if (isset($item['children'])) {
                    updateMenuItems($item['children'], $item['id']);
                }
            }

            
        }

        // Update the menu items
        updateMenuItems($menuItems);

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Menu order updated successfully']);
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        // dd($menuItem);
        $menuItem->delete();

        

        Alert::success('Berhasil', 'Menu Berhasil Dihapus');
        return redirect()->back()->with('success', 'Menu item deleted successfully.');
    }
}
