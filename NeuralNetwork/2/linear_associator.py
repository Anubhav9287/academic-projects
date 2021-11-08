# Sharma, Anubhav
# 1001_864_635
# 2021_10_10
# Assignment_02_01

import numpy as np

class LinearAssociator(object):
    def __init__(self, input_dimensions=2, number_of_nodes=4, transfer_function="Hard_limit"):
        """
        Initialize linear associator model
        :param input_dimensions: The number of dimensions of the input data
        :param number_of_nodes: number of neurons in the model
        :param transfer_function: Transfer function for each neuron. Possible values are:
        "Hard_limit", "Linear".
        """
        self.input_dimensions = input_dimensions
        self.no_of_nodes = number_of_nodes
        self.transfer_function = transfer_function
        self.initialize_weights()

    def initialize_weights(self, seed=None):
        """
        Initialize the weights, initalize using random numbers.
        If seed is given, then this function should
        use the seed to initialize the weights to random numbers.
        :param seed: Random number generator seed.
        :return: None
        """
        if seed != None:
            np.random.seed(seed)
        self.weights = np.random.randn(self.no_of_nodes,self.input_dimensions)

    def set_weights(self, W):
        """
         This function sets the weight matrix.
         :param W: weight matrix
         :return: None if the input matrix, w, has the correct shape.
         If the weight matrix does not have the correct shape, this function
         should not change the weight matrix and it should return -1.
         """
        if self.weights.shape == W.shape:
            self.weights = W
        else:
            return -1

    def get_weights(self):
        """
         This function should return the weight matrix(Bias is included in the weight matrix).
         :return: Weight matrix
         """
        return self.weights

    def predict(self, X):
        """
        Make a prediction on an array of inputs
        :param X: Array of input [input_dimensions,n_samples].
        :return: Array of model outputs [number_of_nodes ,n_samples]. This array is a numerical array.
        """
        dotproduct_matrix = np.dot(self.weights,X)
        if self.transfer_function == "Hard_limit":
            for i in range(dotproduct_matrix.shape[0]):
                for j in range(dotproduct_matrix.shape[1]):
                    if dotproduct_matrix[i, j] >= 0:
                        dotproduct_matrix[i, j] = 1
                    else:
                        dotproduct_matrix[i, j] = 0
        return dotproduct_matrix

    def fit_pseudo_inverse(self, X, y):
        """
        Given a batch of data, and the targets,
        this function adjusts the weights using pseudo-inverse rule.
        :param X: Array of input [input_dimensions,n_samples]
        :param y: Array of desired (target) outputs [number_of_nodes,n_samples]
        """
        X_transpose = X.transpose()
        X_transpose_dot_product = np.dot(X_transpose, X)
        p_inverse = np.linalg.pinv(X_transpose_dot_product)
        p_inverse_dotproduct = np.dot(p_inverse, X_transpose)
        new_W = np.dot(y, p_inverse_dotproduct)
        self.weights = new_W

    def train(self, X, y, batch_size=5, num_epochs=10, alpha=0.1, gamma=0.9, learning="Delta"):
        """
        Given a batch of data, and the necessary hyperparameters,
        this function adjusts the weights using the learning rule.
        Training should be repeated num_epochs time.
        :param X: Array of input [input_dimensions,n_samples]
        :param y: Array of desired (target) outputs [number_of_nodes,n_samples].
        :param num_epochs: Number of times training should be repeated over all input data
        :param batch_size: number of samples in a batch
        :param num_epochs: Number of times training should be repeated over all input data
        :param alpha: Learning rate
        :param gamma: Controls the decay
        :param learning: Learning rule. Possible methods are: "Filtered", "Delta", "Unsupervised_hebb"
        :return: None
        """
        number_of_sample_given = X.shape[1]
        number_of_batch_divided = int(number_of_sample_given / batch_size)
        if number_of_sample_given % batch_size != 0:
            number_of_batch_divided = number_of_batch_divided + 1
        for epoch in range(num_epochs):
            batch_starting = 0
            for each_batch in range(number_of_batch_divided):
                if number_of_sample_given % batch_size != 0:
                    if each_batch == number_of_batch_divided - 1:
                        new_batch_size = number_of_sample_given % batch_size
                else:
                    new_batch_size = batch_size

                end_batch = batch_starting + new_batch_size

                batch_inputs = X[:, batch_starting:end_batch]

                dot_product_W_and_I = np.dot(self.weights, batch_inputs)
                temp_copy = dot_product_W_and_I.copy()
                if self.transfer_function == "Hard_limit":
                    for i in range(dot_product_W_and_I.shape[0]):
                        for j in range(dot_product_W_and_I.shape[1]):
                            if dot_product_W_and_I[i, j] >= 0:
                                temp_copy[i, j] = 1
                            else:
                                temp_copy[i, j] = 0
                batch_inputs_transpose = batch_inputs.transpose()
                t = y[:, batch_starting: end_batch]
                batch_starting = end_batch

                if learning.lower() == "filtered":
                    self.weights = self.weights * (1 - gamma) + alpha * np.dot(t, batch_inputs_transpose)

                if learning.lower() == "delta":
                    err_e = t - temp_copy
                    self.weights = self.weights + alpha * np.dot(err_e, batch_inputs_transpose)

                if learning.lower() == "unsupervised_hebb":
                    self.weights = self.weights + alpha * np.dot(temp_copy, batch_inputs_transpose)

    def calculate_mean_squared_error(self, X, y):
        """
        Given a batch of data, and the targets,
        this function calculates the mean squared error (MSE).
        :param X: Array of input [input_dimensions,n_samples]
        :param y: Array of desired (target) outputs [number_of_nodes,n_samples]
        :return mean_squared_error
        """
        #input array prediction
        input_matrix = self.predict(X)
        sub = input_matrix - y
        sub = np.multiply(sub, sub)
        error = np.mean(sub)
        return error
