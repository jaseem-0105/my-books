import React from "react";
import Navbar from "../../components/layouts/navbar/Navbar";
import SearchInputForm from "../../components/forms/searchinputforms/SearchInputForms"
import './booksPage.styles.css'; 
import ProductListingAll from "../../components/layouts/product-listing-all/ProductListingAll";
import Footer from "../../components/layouts/footer/Footer"
const BooksPage = () => {
    return (
        <div>
            <Navbar darkTheme={true}/>
            <div className="search-container">
                <h2>Find the books that you want</h2>
                <SearchInputForm darkTheme={false}/>
            </div>

            <ProductListingAll/>
            <Footer/>
        </div>
    )
}

export default BooksPage;    