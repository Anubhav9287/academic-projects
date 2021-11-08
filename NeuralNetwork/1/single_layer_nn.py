# Sharma, Anubhav
# 1001_864_635
# 2021_09_26
# Assignment_01_01

import numpy as np

class SingleLayerNN(object):
    def __init__(self, input_dimensions=2,number_of_nodes=4):
        """
        Initialize SingleLayerNN model and set all the weights and biases to random numbers.
        :param input_dimensions: The number of dimensions of the input data
        :param number_of_nodes: Note that number of neurons in the model is equal to the number of classes.
        """
        self.input_dimensions = input_dimensions
        self.number_of_nodes = number_of_nodes
        self.initialize_weights()
    def initialize_weights(self,seed=None):
        """
        Initialize the weights, initalize using random numbers.
        If seed is given, then this function should
        use the seed to initialize the weights to random numbers.
        :param seed: Random number generator seed.
        :return: None
        """
        if seed != None:
            np.random.seed(seed)
        #input_dimensions+1 is done bacause it is done bais is added with weights.
        self.weights = np.random.randn(self.number_of_nodes, self.input_dimensions + 1)

    def set_weights(self, W):
        """
        This function sets the weight matrix (Bias is included in the weight matrix).
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
        #print("-------- WEIGHTS ----- ")
        #print(self.weights)
        return self.weights

    def predict(self, X):
        """
        Make a prediction on a batach of inputs.
        :param X: Array of input [input_dimensions,n_samples]
        :return: Array of model [number_of_nodes ,n_samples]
        Note that the activation function of all the nodes is hard limit.
        """
        c = X.shape[1]
        b_ones = np.array([[1] * c])
        #print(b_ones)
        #new_X = np.concatenate((b_ones, X))
        new_X = np.concatenate((b_ones, X), axis=0)
        new_matrix = np.dot(self.weights, new_X)
        #Logic for hardlim is below:
        for i in range(new_matrix.shape[0]):
            for j in range(new_matrix.shape[1]):
                if new_matrix[i, j] >= 0:
                    new_matrix[i, j] = 1
                else:
                    new_matrix[i, j] = 0
        return new_matrix

    def train(self, X, Y, num_epochs=10,  alpha=0.1):
        """
        Given a batch of input and desired outputs, and the necessary hyperparameters (num_epochs and alpha),
        this function adjusts the weights using Perceptron learning rule.
        Training should be repeated num_epochs times.
        :param X: Array of input [input_dimensions,n_samples]
        :param y: Array of desired (target) outputs [number_of_nodes ,n_samples]
        :param num_epochs: Number of times training should be repeated over all input data
        :param alpha: Learning rate
        :return: None
        """
        b = np.array([[1] * X.shape[1]])
        newX = np.concatenate((b, X), axis=0)
        new_W = self.weights
        for each_p in range(num_epochs):
            i = 0
            for x in newX.T:
                x = np.reshape(x, (newX.shape[0], 1))
                n = np.dot(new_W, x)
                a = 1 * (n > 0)
                y = Y[:, i];
                y = np.reshape(y, (y.shape[0], 1))
                # print("Shape of y: ",y.shape)
                # print("Shape of a: ",a.shape)
                e = y - a
                # print(Y[:][i])
                # print("e shape: ",e.shape)
                old_W = new_W
                new_W = old_W + alpha * np.dot(e, x.T)
                i += 1
        self.weights = new_W

    def calculate_percent_error(self,X, Y):
        """
        Given a batch of input and desired outputs, this function calculates percent error.
        For each input sample, if the output is not the same as the desired output, Y,
        then it is considered one error. Percent error is 100*(number_of_errors/ number_of_samples).
        :param X: Array of input [input_dimensions,n_samples]
        :param y: Array of desired (target) outputs [number_of_nodes ,n_samples]
        :return percent_error
        """
        a = self.predict(X)
        k = np.absolute(Y - a)
        error = 0
        for i in range(k.shape[1]):
            flag = 1
            for j in range(k.shape[0]):
                if k[j][i] != 0:
                    flag = 0
            if flag == 0:
                error = error + 1
        per_error = error / k.shape[1]
        return per_error * 100

if __name__ == "__main__":
    input_dimensions = 2
    number_of_nodes = 2

    model = SingleLayerNN(input_dimensions=input_dimensions, number_of_nodes=number_of_nodes)
    model.initialize_weights(seed=2)
    X_train = np.array([[-1.43815556, 0.10089809, -1.25432937, 1.48410426],
                        [-1.81784194, 0.42935033, -1.2806198, 0.06527391]])
    print(model.predict(X_train))
    Y_train = np.array([[1, 0, 0, 1], [0, 1, 1, 0]])
    print("****** Model weights ******\n",model.get_weights())
    print("****** Input samples ******\n",X_train)
    print("****** Desired Output ******\n",Y_train)
    percent_error=[]
    for k in range (20):
        model.train(X_train, Y_train, num_epochs=1, alpha=0.1)
        percent_error.append(model.calculate_percent_error(X_train,Y_train))
    print("******  Percent Error ******\n",percent_error)
    print("****** Model weights ******\n",model.get_weights())