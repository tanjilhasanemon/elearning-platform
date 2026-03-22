<?php
// Course Detail Page - ENHANCED VERSION
// This page displays individual course details and allows enrollment
// With improved image handling and fallback 

session_start();
include '../includes/header.php';
include '../includes/db_connection.php';

// Define default course image fallback
$default_course_image = 'course-placeholder.png';

// Get course ID from URL
$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Fetch course details
$course_query = "SELECT c.*, u.fullname as instructor_name FROM courses c LEFT JOIN users u ON c.instructor_id = u.id WHERE c.id = " . $course_id;
$course_result = mysqli_query($connection, $course_query);

// Check if course exists
if (!$course_result || mysqli_num_rows($course_result) === 0) {
    header("Location: courses.php");
    exit();
}

$course = mysqli_fetch_assoc($course_result);

// Check if user is already enrolled
$is_enrolled = false;
if ($is_logged_in && $user_id) {
    $enrollment_query = "SELECT id FROM enrollments WHERE student_id = " . $user_id . " AND course_id = " . $course_id;
    $enrollment_result = mysqli_query($connection, $enrollment_query);
    $is_enrolled = mysqli_num_rows($enrollment_result) > 0;
}

// Fetch course lessons
$lessons_query = "SELECT * FROM lessons WHERE course_id = " . $course_id . " AND status = 'published' ORDER BY lesson_number";
$lessons_result = mysqli_query($connection, $lessons_query);
$lessons = array();

if ($lessons_result) {
    while ($row = mysqli_fetch_assoc($lessons_result)) {
        $lessons[] = $row;
    }
}

/**
 * Helper function to get course image with fallback
 */
function get_course_image($thumbnail, $path_prefix, $default) {
    if (!empty($thumbnail)) {
        return $path_prefix . 'images/' . htmlspecialchars($thumbnail);
    }
    return $path_prefix . 'images/' . $default;
}
?>

<!-- ============================================
     COURSE HEADER
     ============================================ -->
<section class="course-header-section">
    <div class="container">
        <div class="course-header-content">
            <div class="course-header-left">
                <h1><?php echo htmlspecialchars($course['title']); ?></h1>
                <p class="course-description"><?php echo htmlspecialchars($course['description']); ?></p>
                <div class="course-info">
                    <span class="instructor">By: <?php echo htmlspecialchars($course['instructor_name'] ?? 'Unknown'); ?></span>
                    <span class="rating">★★★★★ <?php echo htmlspecialchars($course['rating']); ?></span>
                    <span class="students"><?php echo $course['students_count']; ?> students enrolled</span>
                </div>
            </div>
            <div class="course-header-right">
                <div class="course-card-sidebar">
                    <!-- ENHANCED: Shows thumbnail with fallback to default image -->
                    <img 
                        src="<?php echo get_course_image($course['thumbnail'], $path_prefix, $default_course_image); ?>" 
                        alt="<?php echo htmlspecialchars($course['title']); ?>" 
                        class="course-thumbnail"
                        onerror="this.src='<?php echo $path_prefix; ?>images/<?php echo $default_course_image; ?>'">
                    <div class="course-pricing">
                        <h2 class="price">$<?php echo number_format($course['price'], 2); ?></h2>
                    </div>
                    <?php if ($is_logged_in): ?>
                        <?php if ($is_enrolled): ?>
                            <button class="btn btn-success btn-large">✓ Already Enrolled</button>
                        <?php else: ?>
                            <form method="POST" action="../includes/process-enroll.php" style="width: 100%;">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button type="submit" class="btn btn-primary btn-large">Enroll Now</button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn btn-primary btn-large" onclick="window.location.href='login.php'">Login to Enroll</button>
                    <?php endif; ?>
                    <div class="course-meta-info">
                        <div class="meta-item">
                            <strong><?php echo $course['lessons_count'] ?? 0; ?></strong>
                            <span>Lessons</span>
                        </div>
                        <div class="meta-item">
                            <strong><?php echo $course['duration_hours'] ?? 0; ?></strong>
                            <span>Hours</span>
                        </div>
                        <div class="meta-item">
                            <strong><?php echo ucfirst($course['level']); ?></strong>
                            <span>Level</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     COURSE CONTENT SECTION
     ============================================ -->
<section class="course-content-section">
    <div class="container">
        <div class="course-content-layout">
            <!-- Main Content -->
            <div class="course-main">
                <div class="course-section">
                    <h2>About This Course</h2>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                </div>

                <!-- Lessons Section -->
                <?php if (!empty($lessons)): ?>
                    <div class="course-section">
                        <h2>Course Curriculum</h2>
                        <div class="lessons-list">
                            <?php foreach ($lessons as $index => $lesson): ?>
                                <div class="lesson-item">
                                    <div class="lesson-number">Lesson <?php echo $lesson['lesson_number']; ?></div>
                                    <div class="lesson-content">
                                        <h3><?php echo htmlspecialchars($lesson['title']); ?></h3>
                                        <p><?php echo htmlspecialchars($lesson['description'] ?? ''); ?></p>
                                        <span class="lesson-duration"><?php echo $lesson['duration_minutes']; ?> minutes</span>
                                    </div>
                                    <?php if (!$is_enrolled): ?>
                                        <span class="lesson-lock">🔒 Locked</span>
                                    <?php else: ?>
                                        <span class="lesson-unlock">📖 Available</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="course-section">
                    <h2>Course Details</h2>
                    <ul>
                        <li><strong>Level:</strong> <?php echo ucfirst($course['level']); ?></li>
                        <li><strong>Category:</strong> <?php echo htmlspecialchars($course['category']); ?></li>
                        <li><strong>Duration:</strong> <?php echo $course['duration_hours']; ?> hours</li>
                        <li><strong>Total Lessons:</strong> <?php echo $course['lessons_count']; ?></li>
                        <li><strong>Students Enrolled:</strong> <?php echo $course['students_count']; ?></li>
                        <li><strong>Rating:</strong> ★★★★★ <?php echo $course['rating']; ?>/5</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include '../includes/footer.php';
?>
