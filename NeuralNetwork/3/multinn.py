# Sharma, Anubhav
# 1001_864_635
# 2021_10_31
# Assignment_03_01

# %tensorflow_version 2.x
import tensorflow as tf
import numpy as np


class MultiNN(object):
    def __init__(self, input_dimension):
        """
        Initialize multi-layer neural network
        :param input_dimension: The number of dimensions for each input data sample
        """
        self.input_dimension = input_dimension
        self.weights = []
        self.biases = []
        self.activations = []

    # define some of the transfer functions. So that we can call it afterwards.
    def sigmoid(self, x):
        return tf.nn.sigmoid(x)

    def linear(self, x):
        return x

    def relu(self, x):
        out = tf.nn.relu(x)
        return out

    def add_layer(self, num_nodes, transfer_function="Linear"):
        """
         This function adds a dense layer to the neural network
         :param num_nodes: number of nodes in the layer
         :param transfer_function: Activation function for the layer. Possible values are:
        "Linear", "Relu","Sigmoid".
         :return: None
         """
        # Check length of the weight is not equal to 0
        weight_len = len(self.weights)
        if weight_len != 0:
            temp_w = tf.Variable(tf.random.normal((self.weights[-1].shape[1], num_nodes)))
        else:
            temp_w = tf.Variable(tf.random.normal((self.input_dimension, num_nodes)))

        self.weights.append(temp_w)
        temp_baise_val = tf.Variable(tf.random.normal((1, num_nodes), stddev=0.03))
        self.biases.append(temp_baise_val)

        # Here I will check what is the transfer function
        if transfer_function.lower() == "linear":
            self.activations.append(self.linear)
        elif transfer_function.lower() == "sigmoid":
            self.activations.append(self.sigmoid)
        elif transfer_function.lower() == "relu":
            self.activations.append(self.relu)

    def get_weights_without_biases(self, layer_number):
        """
        This function should return the weight matrix (without biases) for layer layer_number.
        layer numbers start from zero.
         :param layer_number: Layer number starting from layer 0. This means that the first layer with
          activation function is layer zero
         :return: Weight matrix for the given layer (not including the biases). Note that the shape of the weight matrix should be
          [input_dimensions][number of nodes]
         """
        return self.weights[layer_number]

    def get_biases(self, layer_number):
        """
        This function should return the biases for layer layer_number.
        layer numbers start from zero.
        This means that the first layer with activation function is layer zero
         :param layer_number: Layer number starting from layer 0
         :return: Weight matrix for the given layer (not including the biases).
         Note that the biases shape should be [1][number_of_nodes]
         """
        return self.biases[layer_number]

    def set_weights_without_biases(self, weights, layer_number):
        """
        This function sets the weight matrix for layer layer_number.
        layer numbers start from zero.
        This means that the first layer with activation function is layer zero
         :param weights: weight matrix (without biases). Note that the shape of the weight matrix should be
          [input_dimensions][number of nodes]
         :param layer_number: Layer number starting from layer 0
         :return: none
         """
        self.weights[layer_number] = weights

    def set_biases(self, biases, layer_number):
        """
        This function sets the biases for layer layer_number.
        layer numbers start from zero.
        This means that the first layer with activation function is layer zero
        :param biases: biases. Note that the biases shape should be [1][number_of_nodes]
        :param layer_number: Layer number starting from layer 0
        :return: none
        """
        self.biases[layer_number] = biases

    def calculate_loss(self, y, y_hat):
        """
        This function calculates the sparse softmax cross entropy loss.
        :param y: Array of desired (target) outputs [n_samples]. This array includes the indexes of
         the desired (true) class.
        :param y_hat: Array of actual output values [n_samples][number_of_classes].
        :return: loss
        """
        return tf.math.reduce_mean(tf.nn.sparse_softmax_cross_entropy_with_logits(labels=y, logits=y_hat))

    def predict(self, X):
        """
        Given array of inputs, this function calculates the output of the multi-layer network.
        :param X: Array of input [n_samples,input_dimensions].
        :return: Array of outputs [n_samples,number_of_classes ]. This array is a numerical array.
        """
        weight_length = len(self.weights)
        result_out = tf.matmul(X, self.weights[0]) + self.biases[0]
        result_out = self.activations[0](result_out)
        for layer in range(1, weight_length):
            result_out = tf.matmul(result_out, self.weights[layer]) + self.biases[layer]
            result_out = self.activations[layer](result_out)
        return result_out

    def train(self, X_train, y_train, batch_size, num_epochs, alpha=0.8):
        """
         Given a batch of data, and the necessary hyperparameters,
         this function trains the neural network by adjusting the weights and biases of all the layers.
         :param X: Array of input [n_samples,input_dimensions]
         :param y: Array of desired (target) outputs [n_samples]. This array includes the indexes of
         the desired (true) class.
         :param batch_size: number of samples in a batch
         :param num_epochs: Number of times training should be repeated over all input data
         :param alpha: Learning rate
         :return: None
         """
        input_data = tf.data.Dataset.from_tensor_slices((X_train, y_train))
        input_data = input_data.batch(batch_size)
        for each_epoch in range(num_epochs):
            for x_input_data, y_input_data in input_data:
                with tf.GradientTape() as tape:
                    prediction_result = self.predict(x_input_data)
                    loss_out = self.calculate_loss(y_input_data, prediction_result)
                    new_weight, new_bias = tape.gradient(loss_out, [self.weights, self.biases])
                    # Adjusting weights
                    for i in range(len(self.weights)):
                        self.weights[i].assign_sub(alpha * new_weight[i])
                        self.biases[i].assign_sub(alpha * new_bias[i])

    def calculate_percent_error(self, X, y):
        """
        Given input samples and corresponding desired (true) output as indexes,
        this method calculates the percent error.
        For each input sample, if the predicted class output is not the same as the desired class,
        then it is considered one error. Percent error is number_of_errors/ number_of_samples.
        Note that the predicted class is the index of the node with maximum output.
        :param X: Array of input [n_samples,input_dimensions]
        :param y: Array of desired (target) outputs [n_samples]. This array includes the indexes of
        the desired (true) class.
        :return percent_error
        """
        y_prediction = self.predict(X)
        a_max = np.argmax(y_prediction, axis=1)
        prediction_false = 0
        for value1, value2 in zip(y, a_max):
            if value1 != value2:
                prediction_false += 1
        percent_error = prediction_false / y.shape[0]
        return percent_error

    def calculate_confusion_matrix(self, X, y):
        """
        Given input samples and corresponding desired (true) outputs as indexes,
        this method calculates the confusion matrix.
        :param X: Array of input [n_samples,input_dimensions]
        :param y: Array of desired (target) outputs [n_samples]. This array includes the indexes of
        the desired (true) class.
        :return confusion_matrix[number_of_classes,number_of_classes].
        Confusion matrix should be shown as the number of times that
        an image of class n is classified as class m.
        """
        predected_value = self.predict(X)
        a = np.argmax(predected_value, axis=1)
        confusion_matrix = np.zeros((predected_value.shape[1], predected_value.shape[1]))
        for value1, value2 in zip(y, a):
            confusion_matrix[value1][value2] += 1
        return confusion_matrix
