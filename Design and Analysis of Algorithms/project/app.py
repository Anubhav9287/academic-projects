import os
from flask import Flask, render_template, request
from flask_wtf import FlaskForm
from flask_bootstrap import Bootstrap
from wtforms import StringField, SubmitField
import numpy as np
import time


app = Flask(__name__)
bootstrap = Bootstrap(app)

# Configurations setup
app.config['SECRET_KEY'] = 'anubhav'
app.config['BOOTSTRAP_BTN_STYLE'] = 'primary'
app.config['BOOTSTRAP_BOOTSWATCH_THEME'] = 'lumen'

class NameForm(FlaskForm):
    name = StringField('Name', default="Anubhav Sharma")
    submit = SubmitField('Submit')


#All Sorting Algorithms are written as functions:

#below function is logic for selection algorithm
def selection_sorting(array):
    input_length = len(array)
    for i in range(input_length):
        minimum = i
        for j in range(i+1, input_length):
            if array[minimum] > array[j]:
                minimum = j
        temp = array[i]
        array[i] = array[minimum]
        array[minimum] = temp
    return array

#Logic for bubble sort
def bubble_sorting(input_array):
    input_length = len(input_array)
    for i in range(input_length-1):
        for j in range(0, input_length-i-1):
            if input_array[j] > input_array[j + 1]:
                temp = input_array[j]
                input_array[j]= input_array[j + 1]
                input_array[j + 1] = temp
    return input_array

#Logic for Merge Sort
def merge_sorting(input_arr):
    if len(input_arr) > 1:
        mid = len(input_arr) // 2
        left = input_arr[:mid]
        right = input_arr[mid:]
        merge_sorting(left)
        merge_sorting(right)
        i = 0
        j = 0
        k = 0
        while i < len(left) and j < len(right):
            if left[i] < right[j]:
              input_arr[k] = left[i]
              i += 1
            else:
                input_arr[k] = right[j]
                j = j + 1
            k = k + 1
        while i < len(left):
            input_arr[k] = left[i]
            i = i + 1
            k = k + 1
        while j < len(right):
            input_arr[k]=right[j]
            j = j + 1
            k = k + 1

#HEAP Sort Logic: two functions heap_sorting and heapify
def heapify(input_arr, value, h):
   large = h
   l = 2 * h + 1
   r = 2 * h + 2
   if l < value and input_arr[h] < input_arr[l]:
      large = l
   if r < value and input_arr[large] < input_arr[r]:
      large = r
   if large != h:
       input_arr[h], input_arr[large] = input_arr[large], input_arr[h]
       heapify(input_arr, value, large)

# Sorting
def heap_sorting(input_arr):
   input_length = len(input_arr)
   for j in range(input_length, -1, -1):
      heapify(input_arr, input_length, j)
   for j in range(input_length-1, 0, -1):
       tmp = input_arr[j]
       input_arr[j]= input_arr[0]
       input_arr[0] = tmp
       heapify(input_arr, j, 0)



#Quick Sort Algo use two functions: partition and quick_sorting
def partition(input_arr, low, high):
    i = (low-1)
    pivot_ele = input_arr[high]
    for j in range(low, high):
        if input_arr[j] <= pivot_ele:
            i = i+1
            temp = input_arr[i]
            input_arr[i] = input_arr[j]
            input_arr[j] = temp
    temp = input_arr[i + 1]
    input_arr[i + 1] = input_arr[high]
    input_arr[high] = temp
    return (i+1)

def quick_sorting(input_arr, low, high):
    if len(input_arr) == 1:
        return input_arr
    if low < high:
        pi = partition(input_arr, low, high)
        quick_sorting(input_arr, low, pi - 1)
        quick_sorting(input_arr, pi + 1, high)


# Quick Sort: 3 medians
def quick_sort_median3(array, start, end):
    if start < end:
        pivot = median3(array, start, end)
        part = partition_median3(array, start, end, pivot)
        quick_sort_median3(array, start, part - 1)
        quick_sort_median3(array, part + 1, end)


def median3(input_arr, low, high):
    mid = (low + high) // 2
    if input_arr[mid] < input_arr[low]:
        swapping(input_arr, low, mid)
    if input_arr[high] < input_arr[low]:
        swapping(input_arr, low, high)
    if input_arr[mid] > input_arr[high]:
        swapping(input_arr, mid, high)
    swapping(input_arr, mid, high)
    return input_arr[high]


def partition_median3(arr, start, end, pivot):
    i = start - 1
    for j in range(start, end + 1):
        if arr[j] <= pivot:
            i += 1
            swapping(arr, i, j)
    return i


# swapping in array from one index to another
def swapping(arr, swap_from_index, swap_to_index):
    temp = arr[swap_from_index]
    arr[swap_from_index] = arr[swap_to_index]
    arr[swap_to_index] = temp


#Varables to store time and arrage the algorithms
calculateTime=[]
arrage=[]


# Creating routes for mapping URLs to application actions

#Home page route /
@app.route('/', methods=['GET', 'POST'])
def index():
    form = NameForm()
    if form.validate_on_submit():
        name = form.name.data
        return render_template('index.html', form=form, name=name)
    return render_template('index.html', form=form, name=None)


#Route for selecting the algorithm
@app.route('/sortingalgoselection', methods=['GET', 'POST'])
def sorting():
    selectedsorting = request.args.get('sort')
    if selectedsorting == "selection":
        return render_template('selectionsort_page1.html')
    if selectedsorting == "insertion":
        return render_template('insertionsort_page1.html')
    if selectedsorting == "bubble":
        return render_template('bubblesort_page1.html')
    if selectedsorting == "merge":
        return render_template('mergesort_page1.html')
    if selectedsorting == "heap":
        return render_template('heapsort_page1.html')
    if selectedsorting == "quick":
        return render_template('quicksort_page1.html')
    if selectedsorting == "quick3":
        return render_template('quicksort_page1_median3.html')
    

#SELECTION SORT START HERE
#first route to load selection sort first page
@app.route('/selectionform1', methods=['GET', 'POST'])
def selectionform1():
    return render_template('selectionsort_page1.html')

#selection route page 2
@app.route('/selectionpage2form', methods=['GET', 'POST'])
def selectionpage2form():
    num = int(request.form['num'])
    return render_template('selectionsort_page2.html', output= num)

#below route is for output of the selection result
@app.route('/selectionoutputform', methods=['GET', 'POST'])
def selectionoutputform():
    temp_arr = str(request.form['arr'])
    start = time.time()
    temp_arr = [int(x) for x in temp_arr.split(',')]
    temp_arr = selection_sorting(temp_arr)
    end = time.time()
    time_calculate = end - start
    arrage.append("Selection Sort" + "Array:" + str(len(temp_arr)))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= temp_arr, Total_time=time_calculate)

#Route for random number generator
@app.route('/selectionRandomform', methods=['GET', 'POST'])
def selectionRandomform():
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    array= list(np.random.randint(field2,field3,field1))
    time_start = time.time()
    array = selection_sorting(array)
    time_end = time.time()
    time_calculate = time_end - time_start
    # for i in arrage:
    #     if i == "selection":
    #         print("I got it")
    arrage.append("Selection Sort" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    time_calculate = "{:.5f}".format(time_calculate)
    return render_template('output_result.html', output= array,Total_time=time_calculate)


#Pie chart repesentation
@app.route('/chart', methods=['GET', 'POST'])
def piechart():
    list_send=[['Sorting', 'Time']]
    for i in range(len(arrage)):
        list_send.append([str(arrage[i]), calculateTime[i]])
    return render_template('output_chart.html', out=list_send)

#Clear all previous data of chart
@app.route('/clearall', methods=['GET', 'POST'])
def clearall():
    del arrage[:]
    del calculateTime[:]
    form = NameForm()
    if form.validate_on_submit():
        name = form.name.data
        return render_template('index.html', form=form, name=name)
    return render_template('index.html', form=form, name=None)



#Insertion Sorting Routes
#Insertion Sort First page render
@app.route('/insertion_sort_form1', methods=['GET', 'POST'])
def insertion_sort_form1():
    return render_template('insertionsort_page1.html')

#Insertion Sort page 2 render form4
@app.route('/insertion_sort_form4', methods=['GET', 'POST'])
def insertion_sort_form4():
    num = int(request.form['num'])
    return render_template('insertionsort_page2.html', output= num)

#Insertion sort Algorithm
def insertion_sorting(input_arr):
    for i in range(1, len(input_arr)):
        current_val = input_arr[i]
        curreny_pos = i
        while curreny_pos > 0 and input_arr[curreny_pos - 1] > current_val:
            input_arr[curreny_pos] = input_arr[curreny_pos - 1]
            curreny_pos = curreny_pos - 1
    return input_arr

#Insertion sort random generator
@app.route('/insertion_sort_form3', methods=['GET', 'POST'])
def insertion_sort_form3():
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    #random number generator
    tmp_arr= list(np.random.randint(field2,field3,field1))
    time_start = time.time()
    tmp_arr = insertion_sorting(tmp_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Insertion Sort" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= tmp_arr,Total_time=time_calculate)

#Insertion sort output display
@app.route('/insertion_sort_form2', methods=['GET', 'POST'])
def insertion_sort_form2():
    input_arr = str(request.form['arr'])
    input_arr = [int(x) for x in input_arr.split(',')]
    time_start = time.time()
    input_arr = insertion_sorting(input_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Insertion Sort" + "Array:" + str(len(input_arr)))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= input_arr, Total_time=time_calculate)


#Bubble sorting Algorithm
@app.route('/bubble_sort_form1', methods=['GET', 'POST'])
def bubble_sort_form1():
    return render_template('bubblesort_page1.html')

#bubble sort form for page1
@app.route('/bubble_sort_form2', methods=['GET', 'POST'])
def bubble_sort_form2():
    temp_arr = str(request.form['arr'])
    temp_arr = [int(x) for x in temp_arr.split(',')]
    input_length = len(temp_arr)
    time_start = time.time()
    temp_arr = bubble_sorting(temp_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Bubble Sort" + "Array:" + str(len(temp_arr)))
    calculateTime.append(time_calculate)
    time_calculate = "{:.5f}".format(time_calculate)
    return render_template('output_result.html', output= temp_arr, Total_time=time_calculate)

#bubble sort form for page2
@app.route('/bubble_sort_form4', methods=['GET', 'POST'])
def bubble_sort_form4():
    number = int(request.form['no'])
    return render_template('bubblesort_page2.html', output= number)

#bubble sort page for output
@app.route('/bubble_sort_form3', methods=['GET', 'POST'])
def bubble_sort_form3():
    time_start = time.time()
    number1 = int(request.form['field1'])
    number2 = int(request.form['field2'])
    number3 = int(request.form['field3'])
    tmp_arr = list(np.random.randint(number2,number3,number1))
    arr_length = len(tmp_arr)
    tmp_arr = bubble_sorting(tmp_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Bubble Sort" + "Array:" + str(number1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= tmp_arr,Total_time=time_calculate)


#Mering Sort routes

#Firstpage of merge sort: Route
@app.route('/merge_sort_form1', methods=['GET', 'POST'])
def merge_sort_form1():
    return render_template('mergesort_page1.html')

#Merge sort route form2: fixed length
@app.route('/merge_sort_form2', methods=['GET', 'POST'])
def merge_sort_form2():
    tmp_arr = str(request.form['arr'])
    tmp_arr = [int(x) for x in tmp_arr.split(',')]
    time_start = time.time()
    merge_sorting(tmp_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Merge Sort" + "Array:" + str(len(tmp_arr)))
    calculateTime.append(time_calculate)
    
  
    return render_template('output_result.html', output= tmp_arr, Total_time=time_calculate)

#Merge sort page 2, for input
@app.route('/merge_sort_form4', methods=['GET', 'POST'])
def merge_sort_form4():
    input_length = int(request.form['no'])
    return render_template('mergesort_page2.html', output= input_length)

#Merge sort form for random generator
@app.route('/merge_sort_form3', methods=['GET', 'POST'])
def merge_sort_form3():
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    tmp_random_arr= list(np.random.randint(field2,field3,field1))
    time_start = time.time()
    merge_sorting(tmp_random_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Merge Sort" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= tmp_random_arr,Total_time=time_calculate)



#Heap sort form1: Page1
@app.route('/heap_sort_form1', methods=['GET', 'POST'])
def heap_sort_form1():
    return render_template('heapsort_page1.html')

#Heap Sort output result
@app.route('/heap_sort_form2', methods=['GET', 'POST'])
def heap_sort_form2():
    input_arr = str(request.form['arr'])
    input_arr = [int(x) for x in input_arr.split(',')]
    time_start = time.time()
    heap_sorting(input_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Heap Sort" + "Array:" + str(len(input_arr)))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= input_arr, Total_time=time_calculate)

#Heap Sort page2
@app.route('/heap_sort_form4', methods=['GET', 'POST'])
def heap_sort_form4():
    input = int(request.form['no'])
    return render_template('heapsort_page2.html', output= input)

#Heap Sort Random generated page with output
@app.route('/heap_sort_form3', methods=['GET', 'POST'])
def heap_sort_form3():
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    time_start = time.time()
    random_tmp_arr = list(np.random.randint(field2,field3,field1))
    heap_sorting(random_tmp_arr)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Heap Sort" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= random_tmp_arr,Total_time=time_calculate)



#Quick Sort: form1 page1
@app.route('/quick_sort_form1', methods=['GET', 'POST'])
def quick_sort_form1():
    return render_template('quicksort_page1.html')

#Quick Sort: Output result
@app.route('/quick_sort_form2', methods=['GET', 'POST'])
def quick_sort_form2():
    time_start = time.time()
    input_arr = str(request.form['arr'])
    input_arr = [int(x) for x in input_arr.split(',')]
    input_arr_length = len(input_arr)
    quick_sorting(input_arr, 0, input_arr_length-1)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Quick Sort" + "Array:" + str(len(input_arr)))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= input_arr, Total_time=time_calculate)

#Quick Sort: Page2
@app.route('/quick_sort_form4', methods=['GET', 'POST'])
def quick_sort_form4():
    input_number = int(request.form['no'])
    return render_template('quicksort_page2.html', output= input_number)

#Quick Sort: Random array
@app.route('/quick_sort_form3', methods=['GET', 'POST'])
def quick_sort_form3():
    time_start = time.time()
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    tmp_random_arr= list(np.random.randint(field2,field3,field1))
    arr_length = len(tmp_random_arr)
    quick_sorting(tmp_random_arr, 0, arr_length-1)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Quick Sort" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= tmp_random_arr,Total_time=time_calculate)



#Render page 1 for quick sort with median 3
@app.route('/quick_sort_median3_form1', methods=['GET', 'POST'])
def quick_sort_median3_form1():
    return render_template('quicksort_page1_median3.html')
# form 2 for quick sort with median 3
@app.route('/quick_sort_median3_form2', methods=['GET', 'POST'])
def quick_sort_median3_form2():
    time_start = time.time()
    input_arr = str(request.form['arr'])
    input_arr = [int(x) for x in input_arr.split(',')]
    arr_length = len(input_arr)
    quick_sort_median3(input_arr,0,arr_length-1)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Quick Sort mediam 3" + "Array:" + str(len(input_arr)))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= input_arr, Total_time=time_calculate)

#page2 for input number for quick sort with median 3
@app.route('/quick_sort_median3_form4', methods=['GET', 'POST'])
def quick_sort_median3_form4():
    input_number = int(request.form['no'])
    return render_template('quicksort_page2_median3.html', output= input_number)

#outout for quick sort with median 3
@app.route('/quick_sort_median3_form3', methods=['GET', 'POST'])
def quick_sort_median3_form3():
    time_start = time.time()
    field1 = int(request.form['field1'])
    field2 = int(request.form['field2'])
    field3 = int(request.form['field3'])
    random_input_arr= list(np.random.randint(field2,field3,field1))
    arr_length = len(random_input_arr)
    quick_sort_median3(random_input_arr,0,arr_length-1)
    time_end = time.time()
    time_calculate = time_end - time_start
    arrage.append("Quick Sort Median 3" + "Array:" + str(field1))
    calculateTime.append(time_calculate)
    return render_template('output_result.html', output= random_input_arr,Total_time=time_calculate)

@app.errorhandler(404)
@app.route("/error404")
def page_not_found(error):
    return render_template('Error_404.html', title='404')


@app.errorhandler(500)
@app.route("/error500")
def requests_error(error):
    return render_template('error_500.html', title='500')


if __name__ == "__main__":
    port = int(os.getenv('PORT', '7000'))
    app.run(host='127.0.0.1', port=port, debug=True)