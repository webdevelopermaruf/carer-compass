# **Assignment 2 New Features**

## **Installation & Setup**

### **1. Prerequisites**
 - Ensure that [Node.js](https:nodejs.org/) is installed on your system.

### **2. Environment Configuration**
 - **Create the `.env` file**:
   ```bash
   cp .env.example .env
   ```
 - **Connect to Your Database**:
   - Open the `.env` file and set your database connection details:
```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
 ```

### **3. Clearing Caches**
 - You need run the following Artisan commands to clear all caches:
    ```bash
   # Clear application cache
   php artisan cache:clear

   # Clear route cache
   php artisan route:clear

   # Clear view cache
   php artisan view:clear
    
   # Clear config cache
   php artisan config:clear

   # Clear all caches (application, route, view, config)
   php artisan optimize:clear
   ```
   - To make sure the website run with required stylings, use incognito mode.
 ### **4. Running Migrations and Seeders**
 - Execute the following commands to migrate the database and seed initial data:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   
### **5. Testing accounts**
- Use the following accounts for testing the project:
```bash
   Admin: email: admin@example.com, password: AdminPass123
   Manager: email: manager@example.com, password: ManagerPass123
   Editor: email: editor@example.com, password: EditorPass123
   User: email: user@example.com, password: EditorPass123
   ```

## Features

### **1. Feature Overview**
- **Feature Name**: Eloquent Relationships and Code Enhancement
- Builds strong, well-structured relationships between the Product, Category, Tag, and User models using Laravel's Eloquent ORM. Leverages eager loading to improve query efficiency and incorporates custom query scopes to simplify and streamline data retrieval.
- These techniques boost performance by reducing the number of database queries through eager loading, while custom query scopes enhance code clarity and encourage reusability.

### **2. Implementation Details**
- **Tools and Libraries Used**: Utilized Laravel's Eloquent ORM for defining model relationships, eager loading methods, and query scopes.
- **Changes Made**:
  - **Models**:
    - **Product Model (`app\Models\Product.php`)**:
      ```php
      public function category()
      {
          return $this->belongsTo(Category::class);
      }

      public function tags()
      {
          return $this->belongsToMany(Tag::class);
      }

      public function scopeOfCategory($query, $categoryId)
      {
          return $query->where('category_id', $categoryId);
      }

      public function scopeWithTags($query, array $tagIds)
      {
          return $query->whereHas('tags', function ($q) use ($tagIds) {
              $q->whereIn('tags.id', $tagIds);
          });
      }
      ```
    - **Category Model (`app\Models\Category.php`)**:
      ```php
      public function products()
      {
          return $this->hasMany(Product::class);
      }
      ```
    - **Tag Model (`app\Models\Tag.php`)**:
      ```php
      public function products()
      {
          return $this->belongsToMany(Product::class);
      }
      ```

### **3. Critical Analysis of the Feature**
- **Purpose and Problem Solved**: Simplifies data relationships and retrieval processes, cutting down on unnecessary queries and boosting overall performance.
- **Advantages**:
  - **Performance**: Eager loading helps avoid the N+1 query problem.
  - **Reusability**: Query scopes allow for reusable and clean query logic.
- **Limitations**:
  - **Complexity**: Overuse of eager loading can lead to unnecessarily large queries.
- **Future Improvements**:
  - Implementing more advanced query scopes for additional filtering.
  - Optimizing eager loading based on usage patterns.

### **4. Testing the Feature**
- **Testing Approach**:
  - Tested various scenarios, including fetching products with specific categories and tags.
- **Scenarios Tested**:
  - Retrieving products by category.
  - Filtering products by multiple tags.
  - Ensuring no N+1 queries occur during data retrieval.

### **5. Usage Examples**
- **Fetching Products with Category and Tags**:
  ```php
        // ProductsController.php
        
        // Initializing query with eager loading
        $query = Product::with(['category', 'tags']);

        // Applying category filter if provided
        if ($request->filled('category')) {
            $query->ofCategory($request->input('category'));
        }

        // Applying tag filter if provided
        if ($request->filled('tags')) {
            $query->withTags($request->input('tags'));
        }
  ```
---

### **1. Feature Overview**
- **Feature Name**: User Authentication
- Implements secure user registration, login, logout, and password reset features while managing user sessions and enforcing strong password policies to safeguard user credentials.
- These measures are crucial for regulating application access, protecting sensitive information, and delivering a personalized user experience.

### **2. Implementation Details**
- **Tools and Libraries Used**: Utilized Laravel's built-in authentication tools, such as the `Auth` facade, middleware, and validation, to streamline and secure user authentication processes.
- **Changes Made**:
  - **AuthController (`app\Http\Controllers\AuthController.php`)**: Handles registration, login, logout, and password reset processes.
    ```php
    public function register(Request $request)
    {
        Validation and user creation
        $request->validate([...]);
        $user = User::create([...]);
        Auth::login($user);
        return redirect()->route('products.index')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        Validation and authentication
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'))->with('success', 'Logged in successfully!');
        }
        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
    ```
  - **Routes (`routes\web.php`)**: Defined authentication routes with throttling to prevent brute-force attacks.
    ```php
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.submit')->middleware('throttle:10,1');
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
        Password Reset Routes
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    ```
  - **Views**: Created Blade templates for registration, login, and password reset forms with Tailwind CSS classes.

### **3. Critical Analysis of the Feature**
- **Purpose and Problem Solved**: Provides secure access control, ensuring only authenticated users can access protected resources.
- **Advantages**:
  - **Security**: Implements password hashing and login throttling to enhance security.
  - **User Experience**: Offers intuitive forms for registration and login.
- **Future Improvements**:
  - Implement email verification for new users.

### **4. Testing the Feature**
- **Testing Approach**:
  - Conducted functional tests for registration, login, logout, and password reset flows.
  - Verified validation rules and error handling.
- **Scenarios Tested**:
  - Successful and failed registration attempts.
  - Login with correct and incorrect credentials.
  - Password reset process with correct and incorrect security answers.

### **5. Feature-Specific Installation**
- **Configuration**: Defined throttling parameters in route middleware to limit login attempts.

### **6. Understanding of Tools/Techniques**
- **Auth Facade**: To manage user authentication processes i.e login and logout.
- **Middleware**: To control access to routes based on authentication status.
- **Validation**: To ensures user inputs meet defined criteria, this enhances data integrity.

### **7. Usage Examples**
- **User Registration Route**:
  ```php
  Route::post('/register', [AuthController::class, 'register'])->name('register.submit')->middleware('throttle:10,1');
  ```
  This route handles user registration with throttling to prevent misuse.

- **Blade Template for Login**:
  ```blade
  <form action="{{ route('login.submit') }}" method="POST">
      @csrf
      <input type="email" name="email" ...>
      <input type="password" name="password" ...>
      <button type="submit">Login</button>
  </form>
  ```
---
### **1. Feature Overview**
- **Feature Name**: Tailwind CSS Integration
- Integrates Tailwind CSS into the Laravel project to enable a utility-first styling approach. It enables responsive design, consistent theming, and speedy UI development.
- Enhances the application's visual attractiveness and responsiveness, offering a consistent user experience across several devices.

### **2. Implementation Details**
- **Tools and Libraries Used**: Integrated Tailwind CSS via Laravel CLI, customized with a `tailwind.config.js` file for theme customization.
- **Changes Made**:
  - **Installation**:
    ```bash
    npm install tailwindcss
    npx tailwindcss init
    ```
  - **Configuration**: Updated `tailwind.config.js` to define custom colors and extend the default theme.
    ```javascript
    module.exports = {
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.vue',
        ],
        theme: {
            extend: {
                colors: {
                    'custom-blue': '#1e3a8a',
                    'custom-blue-dark': '#1e3a8a',
                    'custom-blue-light': '#3b82f6',
                    'custom-white': '#ffffff',
                    'custom-black': '#000000',
                    'custom-green': '#10b981',
                    'custom-red': '#ef4444',
                    'custom-yellow': '#f59e0b',
                },
            },
        },
        plugins: [],
    };
    ```
  - **Stylesheet**: A main CSS file have been created to incorporate Tailwind directives.
    ```css
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

    /* Custom styles */
    .bg-custom-blue-dark { background-color: #1e3a8a; }
    .text-custom-white { color: #ffffff; }
    ```

### **3. Installation & Setup**
1. **Prerequisites**:
   - Node.js and npm installed.
2. **Setup Steps**:
   ```bash
   npm install
   npm install tailwindcss
   npx tailwindcss init
   ```
   Configure `tailwind.config.js` and include Tailwind directives in your CSS files.

### **4. Critical Analysis of the Feature**
- **Purpose and Problem Solved**: Provides a simple and efficient styling technique, decreasing the need for custom CSS and increasing consistency.

- **Advantages**:
  - **Efficiency**: Rapidly builds responsive designs.
  - **Customization**: Easily customizes themes to match branding.
- **Future Improvements**:
  - Explore Tailwind plugins for additional functionality.

### **5. Testing the Feature**
- **Testing Approach**:
  - Verified responsive design across different devices and screen sizes.
  - Used Mobile Simulator extension to check different devices.
- **Tools Used**: Browser developer tools for responsive testing.
- **Scenarios Tested**:
  - Navigation bar responsiveness with the hamburger menu.
  - Form layouts and button styles across devices.


### **6. Understanding of Tools/Techniques**
- **Tailwind CSS**: A utility-first CSS framework that encourages speedy UI creation using preset classes.
- **Responsive Design**: Use Tailwind's responsive utilities to ensure that the application adapts to different screen sizes.

### **7. Usage Examples**
- **Responsive Navigation Bar**:
  ```html
  <nav class="bg-custom-blue p-4 flex items-center justify-between flex-wrap">
      <div class="flex items-center flex-shrink-0 mr-6">
          <a href="{{ route('products.index') }}" class="font-semibold text-xl tracking-tight text-custom-white">Okay Corp</a>
      </div>
      <div class="block lg:hidden">
          <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-custom-white border-custom-white hover:text-custom-blue-light hover:border-custom-blue">
              <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http:www.w3.org/2000/svg">
                  <title>Menu</title>
                  <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
              </svg>
          </button>
      </div>
      <div id="nav-content" class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden">
          <ul class="text-sm lg:flex-grow">
              <li>
                  <a href="{{ route('products.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-custom-white hover:text-custom-blue-light mr-4">
                      Home
                  </a>
              </li>
              <!-- Additional Links -->
          </ul>
          <!-- Authentication Links -->
      </div>
  </nav>
  ```

---

### **1. Feature Overview**
- **Feature Name**: Role-Based Authorization
- Developed a robust permission system to control access to resources based on user roles (Admin, Manager, Editor, User). Configured specific gates to regulate actions such as viewing, creating, editing, and deleting products, categories, and tags.
- Strengthened security by ensuring users can only perform actions allowed by their roles, safeguarding sensitive data and preserving the application's integrity.

### **2. Implementation Details**
- **Tools and Libraries Used**: Utilized Laravel's Gate facade for defining authorization logic, integrated with user roles stored in the database.
- **Changes Made**:
  - **Models**:
    - **Role Model (`app\Models\Role.php`)**:
      ```php
      public function users()
      {
          return $this->hasMany(User::class);
      }
      ```
    - **User Model (`app\Models\User.php`)**:
      ```php
      public function role()
      {
          return $this->belongsTo(Role::class);
      }

      public function hasRole($roleName)
      {
          return $this->role->name === $roleName;
      }
      ```
  - **AuthServiceProvider (`app\Providers\AppServiceProvider.php`)**: Defined gates for various actions based on roles.
    ```php
    public function boot(): void
    {
        $this->registerPolicies();

        Define Gates based on roles

        Gate::define('admin-actions', function (User $user) {
            return $user->role->name === 'Admin';
        });

        Gate::define('create-products', function (User $user) {
            return in_array($user->role->name, ['Admin', 'Manager', 'Editor']);
        });

        Additional Gates for other actions
    }
    ```
  - **Routes (`routes\web.php`)**: Applied `can` middleware to routes to enforce gate rules.
    ```php
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create')->middleware('can:create-products');
    ```
  - **Views**: Utilized Blade directives like `@can` and `@canany` to conditionally display UI elements based on user permissions.
    ```blade
    @can('edit-products')
        <a href="{{ route('products.edit', $product->id) }}" class="text-custom-white hover:text-custom-blue-light">Edit</a>
    @endcan
    ```

### **3. Critical Analysis of the Feature**
- **Purpose and Problem Solved**: Provideed granular control over user permissions, which enhanced security and ensured users access only authorized resources.
- **Advantages**:
  - **Flexibility**: Easily add or modify roles and permissions as the application evolves.
  - **Security**: Prevents unauthorized access and actions, safeguarding data integrity.

### **4. Testing the Feature**
- **Testing Approach**:
  - Verified that users with specific roles can access only permitted routes.
  - Tested middleware enforcement and gate definitions.
- **Scenarios Tested**:
  - Admin users performing all actions.
  - Managers creating and editing products but not deleting.
  - Editors accessing only view and edit functionalities.
  - Regular users restricted to viewing products.
- **Configuration**: Defined roles and associated permissions within the `AuthServiceProvider` and seeded initial roles.


### **8. Usage Examples**
- **Protecting a Route with a Gate**:
  ```php
  Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('can:create-categories');
  ```
  This route allows only users with the `create-categories` permission to access the category creation form, as defined in `AuthServiceProvider`.

- **Blade Conditional Rendering**:
  ```blade
  @can('edit-products')
      <a href="{{ route('products.edit', $product->id) }}" class="text-custom-white hover:text-custom-blue-light">Edit</a>
  @endcan
  ```