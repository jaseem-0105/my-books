import React from "react";
import "./cartItemsContainer.styles.css";
import CartImg from "../../../assets/books-img/wish.jpg";
import { useDispatch, useSelector } from "react-redux";
import { addOrder, removeFromCart } from "../../../redux/cart/cartSlice";
import { baseUrl } from "../../../constants/Constants";
import { useNavigate } from "react-router-dom";

const CartItemsContainer = () => {
    const orderitems = useSelector((state) => state.cart.orderitems);
    const totalAmount = useSelector((state) => state.cart.totalAmount);
    const user = useSelector((state) => state.user.user);

    const dispatch = useDispatch();
    const navigate = useNavigate();

    const onRemoveItem = (item) => {
        dispatch(removeFromCart(item));
    };

    const __placeOrder = () => {
        dispatch(
            addOrder({
                token: user?.user?.auth_token,
                orderitems: orderitems,
                total_amount: totalAmount,
            })
        ).then((response) => {
            navigate("/order-listing", { replace: false });
        });
    };

    return (
        <section className="cart-items-container">
            <div className="container">
                <h2>Cart</h2>
                {orderitems.map((item) => (
                    <div className="cart-item">
                        <div className="cart-item-img-container">
                            <img
                                src={baseUrl + item.image}
                                alt="cart-item-img"
                                className="cart-item-img"
                            />
                        </div>
                        <div className="cart-item-content-container">
                            <h2>{item?.name}</h2>
                            <h3 className="cart-item-price">{item?.price}</h3>

                            <button
                                onClick={() => onRemoveItem(item)}
                                className="delete-cart"
                            >
                                Remove from cart
                            </button>
                        </div>
                    </div>
                ))}
                <div
                    onClick={() => __placeOrder()}
                    className="checkout-section"
                >
                    <div className="total-amount-container">
                        <h3>Total Amount : {totalAmount}</h3>
                    </div>
                    <button className="proceed-to-checkout">
                        Proceed To Checkout
                    </button>
                </div>
            </div>
        </section>
    );
};
export default CartItemsContainer;
