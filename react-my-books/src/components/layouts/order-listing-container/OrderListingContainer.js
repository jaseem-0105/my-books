import React from "react";
import "./orderListingContainer.styles.css";
import OrderImg from "../../../assets/books-img/harrypoter.jpg";
import { useSelector } from "react-redux";

const OrderListingContainer = () => {
    const my_orders = useSelector((state) => state.user.my_orders);

    return (
        <section className="order-items-container">
            <div className="container">
                <h2>My Orders</h2>
                {my_orders?.data?.map((order) => (
                    <React.Fragment>
                        <h6>#{order?.id}</h6>
                        {order?.order_items?.map((item) => (
                            <div className="order-item">
                                <div className="order-item-img-container">
                                    <img
                                        src={OrderImg}
                                        alt="order-item-img"
                                        className="order-item-img"
                                    />
                                </div>
                                <div className="order-item-content-container">
                                    <h2>{item?.book?.name}</h2>
                                    <p>Auhtor Name</p>
                                    <h3 className="order-item-price">Price</h3>
                                </div>
                            </div>
                        ))}
                    </React.Fragment>
                ))}
            </div>
        </section>
    );
};

export default OrderListingContainer;
