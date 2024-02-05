import React, { useState, useEffect } from "react";
import "./productListingAll.styles.css";
import { baseUrl } from "../../../constants/Constants";
import Axios from "../../../Axios";
import { Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { addToCart, removeFromCart } from "../../../redux/cart/cartSlice";

const ProductListingAll = () => {
    const dispatch = useDispatch();
    const orderitems = useSelector((state) => state.cart.orderitems);
    const [books, setBooks] = useState([]);
    useEffect(() => {
        // Fetch data from the API
        Axios.get(`${baseUrl}/api/get-all-books`)
            .then((response) => {
                console.log(response);
                setBooks(response.data.data);
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }, []);


    const onItemClick = (item) => {
        dispatch(addToCart(item));
    };

    const onRemoveItem = (item) => {
        dispatch(removeFromCart(item));
    };
    return (
        <section className="product-listing-all-container">
            <div className="container">
                <div className="grid-container">
                    <div className="grid-item">
                        {books.map((book) => (
                            <div key={book.id} className="product-listing-card">
                                <div className="product-listing-img-container">
                                    <Link to={`/book-details/${book.id}`}>
                                        <img
                                            src={baseUrl + book.image}
                                            alt="product-listing-image"
                                            className="product-listing-image"
                                        />
                                    </Link>
                                </div>
                                <div className="product-listing-details-container">
                                    <h3>{book.name}</h3>
                                    <p className="author-name">
                                        {book.author}{" "}
                                    </p>
                                    <p className="pricing">{book.price} AED</p>
                                </div>

                                {orderitems?.find((oI) => oI.id === book.id) ? (
                                    <div className="product-listing-button">
                                        <div
                                            onClick={() => onRemoveItem(book)}
                                            className="card-button-container"
                                        >
                                            Remove
                                        </div>
                                    </div>
                                ) : (
                                    <div className="product-listing-button">
                                        <div
                                            onClick={() => onItemClick(book)}
                                            className="card-button-container"
                                        >
                                            Add To Cart
                                        </div>
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ProductListingAll;
