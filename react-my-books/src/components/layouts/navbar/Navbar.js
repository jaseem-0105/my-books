import React from "react";
import "./navbar.styles.css";
import { Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { logoutUser } from "../../../redux/user/userSlice";

const Navbar = ({ darkTheme, darkText }) => {
    const dispatch = useDispatch();

    const user = useSelector((state) => state.user.user);

    console.log(user);
    return (
        <section
            className={`navbar-container ${
                darkTheme
                    ? "background-dark relative"
                    : "background-transparent"
            }`}
        >
            <div className="container flex justify-between align-center">
                <a href="#" className="logo">
                    My<span className="text-primary">Books</span>
                </a>

                <nav className="nav-links-container">
                    <Link
                        to="/"
                        className={`${
                            darkText ? "nav-links-dark" : "nav-links"
                        }`}
                    >
                        Home
                    </Link>
                    <Link
                        to="/books"
                        className={`${
                            darkText ? "nav-links-dark" : "nav-links"
                        }`}
                    >
                        Books
                    </Link>
                    <Link
                        to="/cart"
                        className={`${
                            darkText ? "nav-links-dark" : "nav-links"
                        }`}
                    >
                        Cart
                    </Link>
                    <Link
                        to="/order-listing"
                        className={`${
                            darkText ? "nav-links-dark" : "nav-links"
                        }`}
                    >
                        My Orders
                    </Link>

                    {user && user?.success ? (
                        <Link
                            onClick={() => dispatch(logoutUser())}
                            className={`${
                                darkText ? "nav-links-dark" : "nav-links"
                            }`}
                        >
                            Logout
                        </Link>
                    ) : (
                        <>
                            <Link
                                to="/login"
                                className={`${
                                    darkText ? "nav-links-dark" : "nav-links"
                                }`}
                            >
                                Login
                            </Link>
                            <Link
                                to="/signup"
                                className={`${
                                    darkText ? "nav-links-dark" : "nav-links"
                                }`}
                            >
                                Sign up
                            </Link>
                        </>
                    )}
                </nav>
            </div>
        </section>
    );
};

export default Navbar;
