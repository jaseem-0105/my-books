import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import HomePage from "./pages/homepage/HomePage";
import BooksPage from "./pages/bookspage/BooksPage";
import BookDetailPage from "./pages/booksdetailspage/BookDetails";
import Login from "./pages/login-pages/Login";
import SignUp from "./pages/signup-pages/Signup";
import CartPage from "./pages/cart-page/Cartpage";
import OrderListing from "./pages/order-listing/OrderListing";
import SearchPage from "./pages/searchPage/SearchPage";
import Loading from "./components/layouts/loading/Loading"

const App = () => {
    return (
        <BrowserRouter>
        <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="/books" element={<BooksPage />} />
                <Route path="/book-details/:id" element={<BookDetailPage />} />
                <Route path="/signup" element={<SignUp />} />
                <Route path="/login" element={<Login />} />
                <Route path="/cart" element={<CartPage />} />
                <Route path="/order-listing" element={<OrderListing />} />
                <Route path="/search" element={<SearchPage />} />
                <Route path="/loading" element={<Loading/>}/>
            </Routes>
        </BrowserRouter>
    );
};

export default App;
