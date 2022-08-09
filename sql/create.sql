USE Store;
CREATE TABLE products1 (
	id INT AUTO_INCREMENT,
	sku VARCHAR(30) UNIQUE NOT NULL,
	price DECIMAL(10,2),
	name VARCHAR(30) NOT NULL,
	catergory VARCHAR(30),
	attributeName VARCHAR(30),
	attributeValue VARCHAR(30),
	PRIMARY KEY(id)
);
