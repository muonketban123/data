import pandas as pd

# Đường dẫn tới file văn bản chứa dữ liệu
text_file_path = 'C:/xampp/htdocs/doan/RawData/device1/21-06-00-25-09.txt'

# Đọc dữ liệu từ file văn bản
with open(text_file_path, 'r') as file:
    lines = file.readlines()

# Chuyển đổi dữ liệu thành DataFrame
df = pd.DataFrame([line.strip().split(',') for line in lines])

# Thêm dòng tiêu đề
df.columns = ['Time', 'AccX', 'AccY', 'AccZ', 'gx', 'gy', 'gz', 'gocX', 'gocY', 'gocZ']

# Thêm cột "Status" với giá trị "đi bộ"
df = df.assign(Status='walk')

# Đường dẫn và tên file CSV để lưu dữ liệu
csv_file_path = 'C:/Users/DELL/Desktop/falling_detect_training/data/train.csv'

# Lưu DataFrame vào file CSV với tên cột thay vì chỉ số cột
df.to_csv(csv_file_path, index=False, header=True)
